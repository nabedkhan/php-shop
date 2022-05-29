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

    // fetch all products from database
    public function getProducts() {
        $products = [];
        $query = "SELECT * FROM PRODUCTS";
        $response = mysqli_query($this->connection, $query);
        while ($product = mysqli_fetch_assoc($response)) {
            array_push($products, $product);
        }
        return $products;
    }

    // fetch single product from database
    public function getProduct($id) {
        $query = "SELECT * FROM PRODUCTS WHERE ID='$id'";
        $response = mysqli_query($this->connection, $query);
        $product = mysqli_fetch_assoc($response);
        return $product;
    }

    // create a new payment data item
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
}

?>

<!-- id, user_id, payment_id, products, $shipping_charge, $total_amount, $delivered -->