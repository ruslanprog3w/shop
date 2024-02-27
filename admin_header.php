<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../shop/css/style_header_admin.css">
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="admin_panel.php" class="logo"><p>Logo</p></a>
            <nav class="navbar">
                <a href="admin_panel">Головна</a>
                <a href="admin_panel">Продукція</a>
                <a href="admin_panel">Замовлення</a>
                <a href="admin_panel">Користувачі</a>
                <a href="admin_panel">Повідомлення</a>
            </nav>
            <div class="icons">
                <i class="fa-solid fa-user" id="user-btn"></i>
                <i class="fa-solid fa-list" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p> Ім'я : <span> <?php echo $_SESSION['admin_name'];?></span></p>
                <p> Email : <span> <?php echo $_SESSION['admin_email'];?></span></p>
                <form method="post">
                    <button type="submit" class="logout-btn">Вихід</button>
                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>Панель адміністратора</h1>
        </div>
    </div>
    <div class="line"></div>
</body>
</html>