let users = document.querySelector('.users');
let log = document.querySelector('.log');

users.addEventListener('click', function(e){
    e.preventDefault();
    
    if (window.innerWidth > 768){
        log.classList.toggle('hidden');
    } else {
        window.location.href = '/log/login';
    }
});

window.addEventListener('click', function(e){
    if(!users.contains(e.target) && !log.contains(e.target)){
        log.classList.add('hidden');
    }
});