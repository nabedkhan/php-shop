<?php
session_start();
require_once 'helpers/checkUserSession.php';
require_once "helpers/get_title.php";
require_once "helpers/get_url.php";
require_once "functions/dbController.php";
require_once "partials/head.php";
require_once "partials/header.php";
set_title('Register - PHP E-Commerce Shop');

$name = $email = $password = null;
$nameError = $emailError = $passwordError = null;
$connectionError = null;

if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

        try {
            $name = htmlentities($_POST['name']);
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);

            if (empty($name)) {
                $nameError = 'Name is required!';
            }
            if (empty($email)) {
                $emailError = 'Email is required!';
            }
            if (empty($password)) {
                $passwordError = 'Password is required!';
            }

            if (!empty($name) && !empty($email) && !empty($password)) {
                $db = new DbController();
                $user = $db->register($name, $email, $password);
                $_SESSION['toast'] = "User Registered Successfully";
                $_SESSION['user'] = $user['id'];
                header('Location: index.php');
            }

        } catch (Exception $error) {
            $connectionError = $error->getMessage();
        }

    }
}