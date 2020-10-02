let getBtnContact = document.getElementById('btn-contactform');
let getFormContact = document.getElementById('container-form');

getBtnContact.addEventListener('click', function(){  
    getFormContact.classList.toggle('opencontact');  
});