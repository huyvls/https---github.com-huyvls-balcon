<link rel="stylesheet" href="/css/chats.css">

<div class="sidebar">
    <div class="header">
        <h2 class="header-title">Чаты</h2>
        <button class="add-button js-add-button">＋</button>
    </div>
    <div id="chatList" class="chat-list"></div>
</div>

<div class="main-content">
    <p>Выберите чат или <span class="js-create-new">создайте новый</span></p>
</div>

<div id="newChatModal" class="modal-overlay">
    <div class="modal">
        <h3>Создать чат</h3>
        <input id="chatNameInput" type="text" placeholder="Название чата">
        <div class="modal-buttons">
            <button class="cancel js-cancel-button">Отмена</button>
            <button class="create js-create-button">Создать</button>
        </div>
    </div>
</div>

<script src="/js/chats.js"></script>