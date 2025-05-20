let chats = [];


const elements = {
  chatList: document.getElementById('chatList'),
  newChatModal: document.getElementById('newChatModal'),
  chatNameInput: document.getElementById('chatNameInput'),
  addButton: document.querySelector('.js-add-button'),
  createNewLink: document.querySelector('.js-create-new'),
  cancelButton: document.querySelector('.js-cancel-button'),
  createButton: document.querySelector('.js-create-button'),
};


function initEventListeners() {
  elements.addButton.addEventListener('click', openNewChatModal);
  elements.createNewLink.addEventListener('click', openNewChatModal);
  elements.cancelButton.addEventListener('click', closeNewChatModal);
  elements.createButton.addEventListener('click', addChat);
}


function renderChats() {
  elements.chatList.innerHTML = '';
  chats.forEach((chat, index) => {
    const chatEl = document.createElement('div');
    chatEl.className = 'chat-item';
    chatEl.innerHTML = `
      <span>${chat.name}</span>
      <button class="delete-button js-delete-button" data-index="${index}">✖</button>
    `;
    elements.chatList.appendChild(chatEl);
  });

  
  document.querySelectorAll('.js-delete-button').forEach(button => {
    button.addEventListener('click', (e) => {
      const index = e.target.dataset.index;
      deleteChat(index);
    });
  });
}


function openNewChatModal() {
  elements.newChatModal.style.display = 'flex';
  elements.chatNameInput.value = '';
}

function closeNewChatModal() {
  elements.newChatModal.style.display = 'none';
}


function addChat() {
  const name = elements.chatNameInput.value.trim();
  if (name) {
    chats.push({ name });
    renderChats();
    closeNewChatModal();
  }
}

function deleteChat(index) {
  if (confirm('Удалить этот чат?')) {
    chats.splice(index, 1);
    renderChats();
  }
}


document.addEventListener('DOMContentLoaded', () => {
  initEventListeners();
  renderChats(); 
});