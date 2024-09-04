<?php
session_start();

function handleLogin($email, $pass) {
    $servername = "192.168.96.155";
    $username = "root";
    $password = "root";
    $dbname = "login";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        echo "
        <script>
            localStorage.setItem('isLogin', 'true');
            localStorage.setItem('name', '{$name}');
            localStorage.setItem('email', '{$email}');
        </script>
        ";
        header("Location: main.php");
        exit();
    } else {
        throw new Exception("Invalid email or password");
    }

    mysqli_close($conn);
}

try {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    handleLogin($email, $pass);
} catch (Exception $e) {
    echo "<script>
        alert('Incorrect ID or password. Please log in again.');
        window.location.href = 'index.html';
    </script>";
}
?>
