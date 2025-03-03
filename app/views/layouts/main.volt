<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{title}}</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/alert.css">
</head>
<body>
    <header>
        <img src="/img/icon.png"  alt="Profile Picture">
        <nav style="margin-left: auto; margin-right: 35px;">
            <a href="index">Главная</a>
            <a href="profiledit">О Вас</a>
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
            {{ flash.output() }}
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        {{ content() }}
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


<script src="/js/main.js"></script>
</html>
