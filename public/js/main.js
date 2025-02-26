document.addEventListener("DOMContentLoaded", function(){
    
    fetch('/profile/swapThemeRequest',{
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json()) 
    .then(data => {
        
        const theme = document.getElementById('theme'); 
    })
});