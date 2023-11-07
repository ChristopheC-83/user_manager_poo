const alerts = document.querySelectorAll('.alert')

alerts.forEach((alert, index) => {
    alert.style.transform = `translate(-50%, ${60 * index}px)`;
    if(alert){
        setTimeout(() => {
            alert.remove()
        }, 5000);
    
    }
});