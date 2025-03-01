<link rel="stylesheet" href="/css/register.css">


<div class = "form-wrapper">
    <form class="auth-form" action="/register" method="POST" >
        <h2>Регистрация</h2>

        <label for="username">Логин</label>
        <input type="text" id="username" name="username" placeholder="Введите Ваш логин" required>
        
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" placeholder="Введите Ваш пароль" required>

        <label for="repassword">Повтор пароля</label>
        <input type="password" id="repassword" name="password" placeholder="Повторите Ваш пароль" required>

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Введите Ваш логин" required>
        
        <button type="button" id = "accept">Войти</button>
        
        <div class="register-link">
            <p>Если у Вас не нет аккаунта, Вы можете <a href="/">войти</a></p>
        </div>
    </div>
    </form>
    
    <?= $this->getContent() ?>



    <script src="/js/register.js"></script>