<?php
    session_start();
    require_once('config/connect.php');
    if (isset($_POST['email'])){
        $email = $_POST['email'];
        $pass = $_POST['passw'];
        $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$pass."';";
        $res = $conn -> query($sql);
        if ($res && $res -> num_rows == 1) {
            echo 'Sikeres a bejelentkezés';
            $row = $res -> fetch_assoc();
            print_r($row);
            $_SESSION['user'] = array($row['ID'], $row['name']);
            if (isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
            header("Location: index.php");
            
        }else{
            echo 'Sikertelen a bejelentkezés';
            $_SESSION['error'] = "Helytelen belépési adatok";
            header("Location: login.php");
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo file_get_contents("html/login_form.html");
        if (isset($_SESSION['error'])){
            echo "<h2>{$_SESSION['error']}</h2>";
        }
        ?>
    </body>
</html>

