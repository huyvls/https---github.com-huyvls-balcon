<link rel="stylesheet" href="/css/index.css">



<div class = "form-wrapper">
<form class="auth-form" action="/" method="POST" >
    <h2>Авторизация</h2>
    <label for="username">Логин</label>
    <input type="text" id="username" name="username" placeholder="Введите ваш логин" required>
    
    <label for="password">Пароль</label>
    <input type="password" id="password" name="password" placeholder="Введите ваш пароль" required>
    
    <button type="button" id = "accept">Войти</button>
    
    <div class="register-link">
        <p>Если у Вас нет аккаунта, вы можете <a href="/register">зарегистрироваться</a></p>
    </div>
</div>
</form>

<?= $this->getContent() ?>






<h1 style="text-align: center;">Здарова, <?= $username ?>.</h1>
<p style="text-align: center;">Это страница после операций.</p>




<script src="/js/index.js"></script>

