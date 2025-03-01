<link rel="stylesheet" href="/css/profile.css">

<form class="settings-form" method="post">
    <h2>Ваши данные</h2>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="{{email}}">
    </div>
    <div class="form-group">
        <label for="username">Логин</label>
        <input type="text" id="username" placeholder="{{login}}">
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" id="password" placeholder="Введите новый пароль">
    </div>
    <div class="form-group">
        <label for="repassword">Повтор пароля</label>
        <input type="password" id="repassword" name="password" placeholder="Повторите пароль">
    </div>
    <div class="form-group">
        <label for="agree">Я дважды проверил</label>
        <div class="checkbox-wrapper-10">
            <input  type="checkbox" id="cb5" class="tgl tgl-flip">
            <label for="cb5" data-tg-on="Да" data-tg-off="Нет" class="tgl-btn"></label>
          </div>
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