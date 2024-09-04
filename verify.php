<?php
echo "1";
    if(true){
        echo "2";
        
        session_start();

       
    


    // Retrieve OTP from session
    if (true) {
        $name = $_SESSION['name'];
        $sur_name = $_SESSION['sur_name'];
        $email = $_SESSION['email'];
        $pass = $_SESSION['password'];
        
        echo "$name";
        echo "$email";
        echo "$sur_name";
        echo "$pass";


        if (true ) {
            $servername = "192.168.96.155";
            $username = "root";
            $password = "root";
            $dbname = "login";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if ($conn) {
                echo "  connected";

            $qry="INSERT INTO `user_passw` (`name`, `surname`, `email`, `pass`) VALUES ('$name', '$sur_name', '$email', '$pass');";
            $res= mysqli_query($conn,$qry);
            if($res){
                echo "\nINserted";

            echo"
            
        
            <script>
            localStorage.setItem('isLogin', 'true');
            localStorage.setItem('name', '{$name}');
            localStorage.setItem('email', '{$email}');
            
            window.location.href ='verify.html';
            </script>

            ";
            // header("Location: verify.html");
            // exit();
            }
            }
            



        } else {
            // Invalid OTP
            echo "jhat";
        }
    } 
    }

?>
