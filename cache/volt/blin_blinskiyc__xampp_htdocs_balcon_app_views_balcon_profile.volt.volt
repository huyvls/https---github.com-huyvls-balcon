<link rel="stylesheet" href="/css/profile.css">
<link rel="stylesheet" href="/css/form_input_text.css">

<form class="settings-form" method="post">
    <h2>Ваши данные</h2>
    <div class="brutalist-container">
        <input type="email" id="email" class="brutalist-input smooth-type" placeholder="<?= $email ?>">
        <label for="email" class="brutalist-label">Email</label>
    </div>
    <div class="brutalist-container">
        <input type="text" id="username" class="brutalist-input smooth-type" placeholder="<?= $login ?>">
        <label  for="username" class="brutalist-label">Логин</label>
    </div>
    <div class="brutalist-container">
        <input type="password" id="password" class="brutalist-input smooth-type" placeholder="Введите новый пароль">
        <label for="password" class="brutalist-label">Пароль</label>
    </div>
    <div class="brutalist-container">
        <input type="password" id="repassword" name="password"  class="brutalist-input smooth-type"placeholder="Повторите пароль">
        <label for="repassword" class="brutalist-label">Повтор пароля</label>
    </div>
    <div class="brutalist-container">
        <label for="agree" class="brutalist-label">Ядважды проверил</label>
        <div class="checkbox-wrapper-10">
            <input  type="checkbox" id="cb5" class="tgl tgl-flip">
            <label for="cb5" data-tg-on="Да" data-tg-off="Нет" class="tgl-btn"></label>
          </div>
          <br>
    </div>

    <label for="theme" class="theme">
        <span class="theme__toggle-wrap">
            <input id="theme" class="theme__toggle" type="checkbox" role="switch" name="theme" value="light">
            <span class="theme__fill"></span>
            <span class="theme__icon">
                <span class="theme__icon-part"></span>
                <span class="theme__icon-part"></span>
                <span class="theme__icon-part"></span>
                <span class="theme__icon-part"></span>
                <span class="theme__icon-part"></span>
                <span class="theme__icon-part"></span>
                <span class="theme__icon-part"></span>
                <span class="theme__icon-part"></span>
                <span class="theme__icon-part"></span>
            </span>
        </span>
    </label>
    <div class="form-group">
        <button type="button" id = "save">Сохранить</button>
    </div>
</form>



<script src="/js/profile.js" defer></script>