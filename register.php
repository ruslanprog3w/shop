<?php
    include 'connection.php';

    if(isset($_POST['submit-btn'])){
        $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($conn, $filter_name);

        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password); 

        $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
        $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failred1');

        if(mysqli_num_rows($select_user)>0){
            $message[] = 'Користувач уже зареєстрований';
        }else{
            if($password != $cpassword){
                $message[] = 'Пароль не вірний';
            }else{
                mysqli_query($conn, "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$password')") or die('query failed');
                $message[] = 'registered successfully';
                header('location:login.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../shop/css/style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    
    <section class="form-container">
    <?php
    if (isset($message)){
        foreach ($message as $message){
            echo '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="fa-solid fa-xmark" onclick="this.parentElement.remove()"></i>
                </div>
            ';
        }
    }
    ?>
        <form method="post">
            <h1>Реєстрація</h1>
            <input type="text" name="name" placeholder="Введіть своє ім'я" required>
            <input type="email" name="email" placeholder="Введіть свій email" required>
            <input type="password" name="password" placeholder="Введіть пароль" required>
            <input type="password" name="cpassword" placeholder="Підтведіть пароль" required>
            <input type="submit" name="submit-btn" value="Зареєструвати" class="btn">
            <p>Уже маєте аккаунт ? <a href="login.php">Увійти</a></p>
        </form>
    </section>
</body>
</html>