<?php
// XAMPP defaults: MySQL on localhost, user root, blank password.
define('DB_HOST','localhost');
define('DB_NAME','01_flight_reservation_db');
define('DB_USER','root');
define('DB_PASS','');
if (session_status() === PHP_SESSION_NONE) session_start();
function db() {
    static $pdo=null;
    if (!$pdo) $pdo=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
    ]);
    return $pdo;
}
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function go($url) { header('Location: '.$url); exit; }
function logged_in() { return !empty($_SESSION['user_id']); }
function is_admin() { return ($_SESSION['role']??'')==='admin'; }
function require_login() { if (!logged_in()) { flash('Please sign in to continue.'); go('login.php'); } }
function require_admin() { if (!is_admin()) { flash('Admin access required.'); go('login.php'); } }
function flash($message=null) {
    if ($message!==null) { $_SESSION['flash']=$message; return; }
    $m=$_SESSION['flash']??''; unset($_SESSION['flash']); return $m;
}
function csrf_token() { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(24)); return $_SESSION['csrf']; }
function csrf_check() { if($_SERVER['REQUEST_METHOD']==='POST' && !hash_equals($_SESSION['csrf']??'', $_POST['csrf']??'')) { http_response_code(403); exit('Invalid form token. Please go back and retry.'); } }
