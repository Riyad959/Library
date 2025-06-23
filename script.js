// PWA Installation
// let deferredPrompt;
// const installBtn = document.getElementById('installBtn');
// const notification = document.getElementById('notification');
// const notificationText = document.getElementById('notificationText');

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent the mini-infobar from appearing on mobile
    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;
    // Show the install button
    installBtn.style.display = 'inline-flex';
});

installBtn.addEventListener('click', async () => {
    if (!deferredPrompt) return;
    
    // Show the install prompt
    deferredPrompt.prompt();
    
    // Wait for the user to respond to the prompt
    const { outcome } = await deferredPrompt.userChoice;
    
    if (outcome === 'accepted') {
        notificationText.textContent = 'App installed successfully!';
        notification.classList.add('show');
        installBtn.style.display = 'none';
        
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }
    
    // Clear the deferredPrompt variable
    deferredPrompt = null;
});

window.addEventListener('appinstalled', () => {
    // Hide the install button
    installBtn.style.display = 'none';
    deferredPrompt = null;
});

// Service Worker Registration
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('Service Worker registered: ', registration);
            })
            .catch(error => {
                console.log('Service Worker registration failed: ', error);
            });
    });
}

// Sample book download functionality
document.querySelectorAll('.download-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const bookTitle = this.closest('.book-card').querySelector('h3').textContent;
        
        notificationText.textContent = `Downloading "${bookTitle}"...`;
        notification.classList.add('show');
        
        // Simulate download
        setTimeout(() => {
            notificationText.textContent = `"${bookTitle}" downloaded successfully!`;
        }, 1500);
        
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3500);
    });
});

// Sample user deletion
document.querySelectorAll('.action-btn.delete').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr');
        const userName = row.querySelector('td:nth-child(2)').textContent;
        
        if (confirm(`Are you sure you want to delete user: ${userName}?`)) {
            row.style.opacity = '0.5';
            
            // Simulate deletion
            setTimeout(() => {
                row.remove();
                notificationText.textContent = `User "${userName}" deleted successfully!`;
                notification.classList.add('show');
                
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }, 500);
        }
    });
});

// Form submission
document.querySelector('.upload-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const bookTitle = document.getElementById('bookTitle').value;
    
    notificationText.textContent = `Book "${bookTitle}" uploaded successfully!`;
    notification.classList.add('show');
    
    // Reset form
    this.reset();
    
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
});