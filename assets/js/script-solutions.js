const details = document.querySelectorAll("details");
details.forEach((targetDetail) => {
    targetDetail.addEventListener("click", () => {
        details.forEach((detail) => {
            if (detail !== targetDetail) {
                detail.removeAttribute("open");
            }
        });
    });
});



let btnNavigation = document.querySelectorAll('#btn-navigation');
btnNavigation.forEach(btn => {
    btn.addEventListener('click', function() {
        btnNavigation.forEach(btnNavigation => btnNavigation.classList.remove('active'));
        this.classList.add('active');
    });
});