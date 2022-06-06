<?php
session_start();
require_once 'helpers/checkUserSession.php';
require_once "functions/dbController.php";
require_once "helpers/get_title.php";
require_once "partials/head.php";
require_once "partials/header.php";
set_title('Login - PHP E-Commerce Shop');

$email = $password = null;
$emailError = $passwordError = null;
$connectionError = null;

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        try {
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);

            if (empty($email)) {
                $emailError = 'Email is required!';
            }
            if (empty($password)) {
                $passwordError = 'Password is required!';
            }

            if (!empty($email) && !empty($password)) {
                $db = new DbController();
                $user = $db->login($email, $password);
                $_SESSION['toast'] = "User Logged In Successfully";
                $_SESSION['user'] = $user['id'];
                $_SESSION['admin'] = $user['admin'] ?? null;

                if ($_GET['redirect']):
                    header('Location: ' . $_GET['redirect']);
                else:
                    header('Location: index.php');
                endif;
            }

        } catch (Exception $error) {
            $connectionError = $error->getMessage();
        }

    }
}