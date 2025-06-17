<link rel="stylesheet" href="/css/chats.css">

<div class="chat-app">
    <div class="sidebar">
        <div class="header">
            <h2 class="header-title">Чаты</h2>
            <button class="add-button js-add-button">＋</button>
        </div>
        <div class="chat-list-container">
            <div id="chatList" class="chat-list">
            </div>
        </div>
    </div>
    

    <div class="chat-window" style="display: none;">
        <div class="chat-header">
            <h2 class="chat-title">Название чата</h2>
        </div>
    
    
        <div class="message-history">
    
        </div>
    
    
        <div class="message-input">
            <textarea placeholder="Введите сообщение..."></textarea>
            <button class="send-button">Отправить</button>
        </div>
    </div>
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


<script type="module" src="/js/chats/Main.js" defer></script>