const theme = localStorage.getItem('theme');

        if (theme === 'dark') { 
            document.body.classList.add('dark-theme'); 
        } else {
            document.body.classList.remove('dark-theme'); 
        }

