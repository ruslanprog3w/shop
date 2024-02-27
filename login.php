<?php
    include 'connection.php';
    session_start();

    if(isset($_POST['submit-btn'])){
    
        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password); 

        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failred1');

        if(mysqli_num_rows($select_user)>0){
            $message[] = 'Користувач уже зареєстрований';
            $row = mysqli_fetch_assoc($select_user);
            if($row['user_type']=='admin'){
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_pannel.php');
            }else if($row['user_type']=='user'){
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:index.php');
            }else{
                $message[] = 'Невірний email або пароль';
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
        <form method="post" class=formlog>
            <h1>Увійти в свій аккаунт</h1>
            <div class="input-field1">
                <input type="email" name="email" placeholder="Введіть свій email" required>
            </div>
            <div class="input-field2">
                <input type="password" name="password" placeholder="Введіть пароль" required>
            </div>
            <input type="submit" name="submit-btn" value="Увійти" class="btn">
            <div class="field3">
            
            <p>Не маєте аккаунта ? <a href="register.php">Зареєструвати</a></p>
            </div>
        </form>
    </section>
</body>
</html>