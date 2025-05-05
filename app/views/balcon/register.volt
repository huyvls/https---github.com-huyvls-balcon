<link rel="stylesheet" href="/css/auth.css">
<link rel="stylesheet" href="/css/form_input_text.css">


<div class="form-wrapper">
    <form class="auth-form" action="/register" method="POST">
        <h2>Регистрация</h2>
        <div class="brutalist-container">
            <input type="text" id="username" name="username" class="brutalist-input smooth-type"
                placeholder="Введите Ваш логин" required>
            <label for="username" class="brutalist-label">Логин</label>
        </div>
        <div class="brutalist-container">
            <input type="password" id="password" name="password" class="brutalist-input smooth-type"
                placeholder="Введите Ваш пароль" required>
            <label for="password" class="brutalist-label">Пароль</label>
        </div>
        <div class="brutalist-container">
            <input type="password" id="repassword" name="password" class="brutalist-input smooth-type"
                placeholder="Повторите Ваш пароль" required>
            <label for="repassword" class="brutalist-label">Повтор пароля</label>
        </div>
        <div class="brutalist-container">
            <input type="text" id="email" name="email" class="brutalist-input smooth-type"
                placeholder="Введите Ваш email" required>
            <label for="email" class="brutalist-label">Email</label>
        </div>
        <button type="button" id="accept">Войти</button>

        <div class="register-link">
            <p>Если у Вас не нет аккаунта, Вы можете <a href="/">войти</a></p>
        </div>
</div>
</form>

{{ content() }}



<script src="/js/register.js"></script>