<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            max-width: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
            max-width: 100%;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: black;
            font-size: 14px;
        }

        nav a:hover {
            color: rgb(151, 43, 155);
        }

        .cart {
            position: relative;
            display: flex;
            align-items: center;
        }

        .cart img {
            width: 20px;
            height: 20px;
        }

        .cart span {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: rgb(65, 192, 128);
            color: white;
            font-size: 10px;
            border-radius: 50%;
            padding: 2px 6px;
        }

        footer {
            margin-top: auto;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        
    </style>
    <link rel="stylesheet" href="/css/alert.css">
</head>
<body>
    <header>
        <img src="/img/icon.png"  alt="Profile Picture">
        <nav style="margin-left: auto; margin-right: 35px;">
            <a href="index">Главная</a>
            <a href="about">О Вас</a>
            <a href="fanat">AntifanatFace</a>
            <a href="eshkere">Эщкере</a>
            <a href="shop">Магазин</a>
        </nav>

        
<div class="cart" style="float: right; margin-right: 10px;">
    <img src="img/trash-icon.png" alt="Cart Icon">
    <span>0</span>
</div>
    </header>
    <main>
        <div class="flash-messages">
            <?= $this->flash->output() ?>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?= $this->getContent() ?>
        <br>
        <br>
        <br>
        <br>
        <br>
    </main>
    <footer>
        <p>Никакие права не защищены</p>
    </footer>
</body>
</html>
