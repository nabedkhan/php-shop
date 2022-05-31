<?php
require_once "config/index.php";

class DbController {
    private $connection;

    public function __construct() {
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->connection) {
            throw new Exception('Database not connected');
        }
    }

    /**
     * register user handler
     * @param  string $name
     * @param  string $email
     * @param  string $password
     * @return string[]
     */
    public function register($name, $email, $password) {
        $findQuery = "SELECT EMAIL FROM USERS WHERE EMAIL='$email'";
        $response = mysqli_query($this->connection, $findQuery);
        if (mysqli_fetch_row($response)) {
            throw new Exception('User exist with given email address', 400);
        } else {
            $hashPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO USERS VALUES ( DEFAULT ,'$name', '$email', '$hashPassword')";
            if (mysqli_query($this->connection, $query)) {
                $user = $this->login($email, $password);
                return $user;
            }
        }

    }

    /**
     * login
     * @param  string $email
     * @param  string $password
     * @return array | user array
     */
    public function login($email, $password) {
        $query = "SELECT * FROM USERS WHERE email= '$email'";
        $response = mysqli_query($this->connection, $query);
        $user = mysqli_fetch_assoc($response);

        if ($user) {
            $verifyPassword = password_verify($password, $user['password']);
            if ($verifyPassword) {
                return [
                    'name'  => $user['name'],
                    'email' => $user['email'],
                    'id'    => $user['id'],
                ];
            } else {
                throw new Exception('Invalid Password');
            }
        } else {
            throw new Exception('Not Found with given email address');
        }
    }

    /**
     * get logged ing current user
     * @param  int|string $id
     * @return array | return a user array
     */
    public function getCurrentUser($id) {
        $query = "SELECT * FROM USERS WHERE ID='$id'";
        $response = mysqli_query($this->connection, $query);
        if ($user = mysqli_fetch_assoc($response)) {
            return [
                'name'  => $user['name'],
                'email' => $user['email'],
                'id'    => $user['id'],
            ];
        } else {
            throw new Exception('User Not Found!', 404);
        }
    }

    /**
     * fetch all products from database
     * @return array  | array of products
     */
    public function getProducts() {
        $products = [];
        $query = "SELECT * FROM PRODUCTS";
        $response = mysqli_query($this->connection, $query);
        while ($product = mysqli_fetch_assoc($response)) {
            array_push($products, $product);
        }
        return $products;
    }

    /**
     * get a single product
     * @param  int|string $id
     * @return array  | return a product
     */
    public function getProduct($id) {
        $query = "SELECT * FROM PRODUCTS WHERE ID='$id'";
        $response = mysqli_query($this->connection, $query);
        $product = mysqli_fetch_assoc($response);
        return $product;
    }

    /**
     * create a new payment data item
     * @param  mixed $payment
     * @param  int|string $user_id
     * @return int|string  | return inserted last id
     */
    public function createPayment(array $payment, $user_id) {
        $charge_id = $payment['chargeId'];
        $charge_amount = $payment['chargeAmount'];
        $card_type = $payment['cardType'];
        $payment_status = $payment['paymentStatus'];

        $query = "INSERT INTO PAYMENTS VALUES (DEFAULT, '$charge_id', '$charge_amount', '$card_type', '$payment_status', '$user_id')";

        if (mysqli_query($this->connection, $query)) {
            return mysqli_insert_id($this->connection);
        }
    }

    /**
     * create a new order data
     * @param  int|string $userId
     * @param  int|string $paymentId
     * @return int | return last inserted id
     */
    public function createOrder($userId, $paymentId) {
        $query = "INSERT INTO ORDERS VALUES (DEFAULT, '$userId', '$paymentId', DEFAULT, DEFAULT, DEFAULT)";
        if (mysqli_query($this->connection, $query)) {
            return mysqli_insert_id($this->connection);
        }
    }

    /**
     * store all products and quantity from a order
     * @param  int|string $productId
     * @param  int|string $orderId
     * @param  int|string $quantity
     * @return void
     */
    public function createOrderDetails($productId, $orderId, $quantity) {
        $query = "INSERT INTO ORDERDETAILS VALUES (DEFAULT, '$productId', '$orderId', '$quantity')";
        if (!mysqli_query($this->connection, $query)) {
            throw new Exception("Order Details doesn't created");
        }
    }

    /**
     * create a shipping address for a order
     * @param  array $shipping
     * @param  int|string $orderId
     * @return void
     */
    public function createShipping(array $shipping, $orderId) {
        $name = $shipping['name'];
        $email = $shipping['email'];
        $phone = $shipping['phone'];
        $address = $shipping['address'];

        $query = "INSERT INTO SHIPPING VALUES (DEFAULT, '$name', '$email', '$phone', '$address', '$orderId')";

        if (!mysqli_query($this->connection, $query)):
            throw new Exception("Database query error");
        endif;

    }

    /**
     * update product quantity after a order
     * @param  string|int $productId
     * @param  string|int $quantity
     * @return void
     */
    public function updateProductStock($productId, $quantity) {
        $query = "UPDATE PRODUCTS SET STOCK = STOCK - '$quantity' WHERE ID='$productId'";
        if (!mysqli_query($this->connection, $query)):
            throw new Exception("Database query error");
        endif;
    }

    /**
     * get all orders under a single user
     * @param  mixed $userId
     * @return array
     */
    public function getSingleUserOrders($userId) {
        $orders = [];
        $query = "SELECT orders.id, orders.created_at, payments.charge_amount FROM ORDERS
        JOIN PAYMENTS ON ORDERS.PAYMENT_ID = PAYMENTS.ID WHERE ORDERS.USER_ID='$userId'";

        $response = mysqli_query($this->connection, $query);
        while ($order = mysqli_fetch_assoc($response)) {
            array_push($orders, $order);
        }
        return $orders;
    }

    public function getOrderDetails($orderId) {
        $products = [];
        $order_details = [];

        $query = "SELECT
        products.id, products.name, products.price, products.image, orderdetails.quantity
        FROM ORDERDETAILS
        JOIN PRODUCTS ON ORDERDETAILS.PRODUCT_ID = PRODUCTS.ID
        WHERE ORDERDETAILS.ORDER_ID = '$orderId'";

        $response = mysqli_query($this->connection, $query);
        while ($product = mysqli_fetch_assoc($response)) {
            array_push($products, $product);
        }

        $query2 = "SELECT *
        FROM ORDERS
        JOIN SHIPPING ON SHIPPING.ORDER_ID = ORDERS.ID
        JOIN PAYMENTS ON PAYMENTS.ID = ORDERS.PAYMENT_ID
        WHERE ORDERS.ID = '$orderId'";

        $response2 = mysqli_query($this->connection, $query2);
        while ($details = mysqli_fetch_assoc($response2)) {
            array_push($order_details, $details);
        }
        return [
            'products'      => $products,
            'order_details' => $order_details,
        ];
    }
}