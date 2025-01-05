<style>

.rectangle {
      position: fixed; 
      top: 20px;
      right: 20px;
      width: 200px;
      height: 100px;
      background-color: #3498db;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      border-radius: 8px;
      opacity: 1;
      transition: opacity 1s ease-out;
    }

    /* Класс для исчезания */
    .fade-out {
      opacity: 0;
    }

    .auth-form {
        position: absolute;
        top: 30%; 
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }
    .form-wrapper {
            position: relative; 
            width: 100%; 
            height: 100vh; 
        }
    .auth-form h2 {
        margin: 0 0 20px;
        text-align: center;
    }
    .auth-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }
    .auth-form input[type="text"],
    .auth-form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .auth-form button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }
    .auth-form button:hover {
        background-color: #0056b3;
    }
    .auth-form .register-link {
        text-align: center;
        margin-top: 20px;
    }
    .auth-form .register-link a {
        color: #007bff;
        text-decoration: none;
    }
    .auth-form .register-link a:hover {
        text-decoration: underline;
    }
</style>


<div class = "form-wrapper">
<form class="auth-form" action="/" method="POST" >
    <h2>Авторизация</h2>
    <label for="username">Логин</label>
    <input type="text" id="username" name="username" placeholder="Введите ваш логин" required>
    
    <label for="password">Пароль</label>
    <input type="password" id="password" name="password" placeholder="Введите ваш пароль" required>
    
    <button type="submit">Войти</button>
    
    <div class="register-link">
        <p>Если у Вас нет аккаунта, вы можете <a href="/register">зарегистрироваться</a></p>
    </div>
</div>
</form>

<?= $this->getContent() ?>
<?php if ($need) { ?>
<div id="rectangle" class="rectangle">
    Это исчезающий прямоугольник!
  </div>
  <?php } ?>


<?php if (!$auth) { ?>
<h1 style="text-align: center;">Здарова, <?= $username ?>.</h1>
<p style="text-align: center;">Это страница после операций.</p>

<?php } ?>


<script src="/js/index.js"></script>
<script>
    // Функция для исчезания прямоугольника через 3 секунды
    setTimeout(() => {
      document.getElementById('rectangle').classList.add('fade-out');
    }, 3000); // 3000 мс (3 секунды) перед исчезанием
  </script>
