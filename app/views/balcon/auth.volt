<link rel="stylesheet" href="/css/auth.css">

{%if reg %}
<h1 style="text-align: center;">Зарегистрирован, входи</h1>
{% endif %}
<div class = "form-wrapper">
<form class="auth-form" action="/" method="POST" >
    <h2>Авторизация</h2>
    <label for="username">Логин</label>
    <input type="text" id="username" name="username" placeholder="Введите Ваш логин" required>
    
    <label for="password">Пароль</label>
    <input type="password" id="password" name="password" placeholder="Введите Ваш пароль" required>
    
    <button type="button" id = "accept">Войти</button>
    
    <div class="register-link">
        <p>Если у Вас нет аккаунта, Вы можете <a href="/register">зарегистрироваться</a></p>
    </div>
</div>
</form>

{{ content() }}






<h1 style="text-align: center;">Приветствую, {{ username }}.</h1>
<p style="text-align: center;">Войди чтобы ознакомиться</p>




<script src="/js/auth.js"></script>

