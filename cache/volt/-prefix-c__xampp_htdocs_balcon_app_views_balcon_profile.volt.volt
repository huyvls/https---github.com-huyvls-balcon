<link rel="stylesheet" href="/css/profile.css">

<form class="settings-form" method="post">
    <h2>Ваши данные</h2>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="<?= $email ?>">
    </div>
    <div class="form-group">
        <label for="username">Логин</label>
        <input type="text" id="username" placeholder="<?= $login ?>">
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" id="password" placeholder="Введите новый пароль">
    </div>
    <div class="form-group">
        <input type="checkbox" id="agree">
        <label for="agree">Я дважды проверил</label>
    </div>
    <div class="form-group">
        <button type="button">Сохранить</button>
    </div>
</form>