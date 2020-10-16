if (window.innerWidth < 1024) {
    function togglePasswordType() {
        let passwordType = document.getElementById('user-password');
        let changeImgPassword = document.getElementById('togglePasswordType')
        if (passwordType.type == 'password') {
            passwordType.type = 'text';
            changeImgPassword.innerHTML = `<img id="" src="../assets/img/login/icone-togglepasswordtype.svg" alt="">`;
        }
        else {
            passwordType.type = 'password';
            changeImgPassword.innerHTML = `<img id="" src="../assets/img/login/icone-passwordtype.svg" alt="">`;       
        }
    }
} else if (window.innerWidth > 1024) {

    let passwordType = document.getElementById('user-password');
    let changeImgPassword = document.getElementById('togglePasswordType');
    changeImgPassword.addEventListener('mousedown', () => {
        if (passwordType.type == 'password') {
            passwordType.type = 'text';
            changeImgPassword.innerHTML = `<img id="" src="../assets/img/login/icone-togglepasswordtype.svg" alt="">`;   
        }
    });
    changeImgPassword.addEventListener('mouseup', () => {
        if (passwordType.type == 'text') {
            passwordType.type = 'password';
            changeImgPassword.innerHTML = `<img id="" src="../assets/img/login/icone-passwordtype.svg" alt="">`;
        }
    });
}
