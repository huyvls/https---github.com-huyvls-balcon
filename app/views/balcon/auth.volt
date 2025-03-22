<link rel="stylesheet" href="/css/auth.css">

{%if reg %}
<h1 style="text-align: center;">Зарегистрирован, входи</h1>
{% endif %}
<div class = "form-wrapper">
<form class="auth-form" action="/" method="POST" >
    <h2>Авторизация</h2>
    <div class="brutalist-container">
        <input
          id="username" 
          name="username"
          placeholder="Не почту"
          class="brutalist-input smooth-type"
          type="text"
          required
        />
        <label class="brutalist-label">Логин</label>
      </div>
      
      <div class="brutalist-container">
        <input
          id="password" 
          name="password"
          placeholder="Вводи, не бойся!"
          class="brutalist-input smooth-type"
          type="password"
          required
        />
        <label class="brutalist-label">Пароль</label>
      </div>
    
    <button type="button" id = "accept">Войти</button>
    
    <div class="register-link">
        <p>Если у Вас нет аккаунта, Вы можете <a href="/register">зарегистрироваться</a></p>
    </div>
</div>
</form>

{{ content() }}


<script src="/js/auth.js"></script>

