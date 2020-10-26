let btnNav = document.querySelectorAll('.btnnav');
let btnNavArray = Array.from(btnNav);
let solutionText = document.querySelectorAll('.solutionText')
let solutionTextArray = Array.from(solutionText);
btnNavArray.forEach(btn => {
    btn.addEventListener('click', function () {
        btnNavArray.forEach(btnNavArray => btnNavArray.classList.remove('solutionIsActive'));
        this.classList.add('solutionIsActive');
        if (btnNav[0].classList.contains('solutionIsActive')) {
            solutionText[0].style.display = "block";
            solutionText[1].style.display = "none";
            solutionText[2].style.display = "none";
            solutionText[3].style.display = "none";
            solutionText[4].style.display = "none";
        }
        if (btnNav[1].classList.contains('solutionIsActive')) {
            solutionText[1].style.display = "block";
            solutionText[2].style.display = "none";
            solutionText[3].style.display = "none";
            solutionText[4].style.display = "none";
            solutionText[0].style.display = "none";
        }
        if (btnNav[2].classList.contains('solutionIsActive')) {
            solutionText[2].style.display = "block";
            solutionText[3].style.display = "none";
            solutionText[4].style.display = "none";
            solutionText[0].style.display = "none";
            solutionText[1].style.display = "none";
        }
        if (btnNav[3].classList.contains('solutionIsActive')) {
            solutionText[3].style.display = "block";
            solutionText[4].style.display = "none";
            solutionText[0].style.display = "none";
            solutionText[1].style.display = "none";
            solutionText[2].style.display = "none";
        }
        if (btnNav[4].classList.contains('solutionIsActive')) {
            solutionText[4].style.display = "block";
            solutionText[0].style.display = "none";
            solutionText[1].style.display = "none";
            solutionText[2].style.display = "none";
            solutionText[3].style.display = "none";
        }
        if (btnNav[5].classList.contains('solutionIsActive')) {
            solutionText[5].style.display = "block";
            solutionText[6].style.display = "none";
            solutionText[7].style.display = "none";
            solutionText[8].style.display = "none";
            solutionText[9].style.display = "none";
        }
        if (btnNav[6].classList.contains('solutionIsActive')) {
            solutionText[6].style.display = "block";
            solutionText[7].style.display = "none";
            solutionText[8].style.display = "none";
            solutionText[9].style.display = "none";
            solutionText[5].style.display = "none";
        }
        if (btnNav[7].classList.contains('solutionIsActive')) {
            solutionText[7].style.display = "block";
            solutionText[8].style.display = "none";
            solutionText[9].style.display = "none";
            solutionText[5].style.display = "none";
            solutionText[6].style.display = "none";
        }
        if (btnNav[8].classList.contains('solutionIsActive')) {
            solutionText[8].style.display = "block";
            solutionText[9].style.display = "none";
            solutionText[5].style.display = "none";
            solutionText[6].style.display = "none";
            solutionText[7].style.display = "none";
        }
        if (btnNav[9].classList.contains('solutionIsActive')) {
            solutionText[9].style.display = "block";
            solutionText[5].style.display = "none";
            solutionText[6].style.display = "none";
            solutionText[7].style.display = "none";
            solutionText[8].style.display = "none";
        }
        if (btnNav[10].classList.contains('solutionIsActive')) {
            solutionText[10].style.display = "block";
            solutionText[11].style.display = "none";
            solutionText[12].style.display = "none";
            solutionText[13].style.display = "none";
            solutionText[14].style.display = "none";
        }
        if (btnNav[11].classList.contains('solutionIsActive')) {
            solutionText[11].style.display = "block";
            solutionText[12].style.display = "none";
            solutionText[13].style.display = "none";
            solutionText[14].style.display = "none";
            solutionText[10].style.display = "none";
        }
        if (btnNav[12].classList.contains('solutionIsActive')) {
            solutionText[12].style.display = "block";
            solutionText[13].style.display = "none";
            solutionText[14].style.display = "none";
            solutionText[10].style.display = "none";
            solutionText[11].style.display = "none";
        }
        if (btnNav[13].classList.contains('solutionIsActive')) {
            solutionText[13].style.display = "block";
            solutionText[14].style.display = "none";
            solutionText[10].style.display = "none";
            solutionText[11].style.display = "none";
            solutionText[12].style.display = "none";
        }
        if (btnNav[14].classList.contains('solutionIsActive')) {
            solutionText[14].style.display = "block";
            solutionText[10].style.display = "none";
            solutionText[11].style.display = "none";
            solutionText[12].style.display = "none";
            solutionText[13].style.display = "none";
        }
        if (btnNav[15].classList.contains('solutionIsActive')) {
            solutionText[15].style.display = "block";
            solutionText[16].style.display = "none";
            solutionText[17].style.display = "none";
            solutionText[18].style.display = "none";
            solutionText[19].style.display = "none";
        }
        if (btnNav[16].classList.contains('solutionIsActive')) {
            solutionText[16].style.display = "block";
            solutionText[17].style.display = "none";
            solutionText[18].style.display = "none";
            solutionText[19].style.display = "none";
            solutionText[15].style.display = "none";
        }
        if (btnNav[17].classList.contains('solutionIsActive')) {
            solutionText[17].style.display = "block";
            solutionText[18].style.display = "none";
            solutionText[19].style.display = "none";
            solutionText[15].style.display = "none";
            solutionText[16].style.display = "none";
        }
        if (btnNav[18].classList.contains('solutionIsActive')) {
            solutionText[18].style.display = "block";
            solutionText[19].style.display = "none";
            solutionText[15].style.display = "none";
            solutionText[16].style.display = "none";
            solutionText[17].style.display = "none";
        }
        if (btnNav[19].classList.contains('solutionIsActive')) {
            solutionText[19].style.display = "block";
            solutionText[15].style.display = "none";
            solutionText[16].style.display = "none";
            solutionText[17].style.display = "none";
            solutionText[18].style.display = "none";
        }
        if (btnNav[20].classList.contains('solutionIsActive')) {
            solutionText[20].style.display = "block";
            solutionText[21].style.display = "none";
            solutionText[22].style.display = "none";
            solutionText[23].style.display = "none";
            solutionText[24].style.display = "none";
        }
        if (btnNav[21].classList.contains('solutionIsActive')) {
            solutionText[21].style.display = "block";
            solutionText[22].style.display = "none";
            solutionText[23].style.display = "none";
            solutionText[24].style.display = "none";
            solutionText[20].style.display = "none";
        }
        if (btnNav[22].classList.contains('solutionIsActive')) {
            solutionText[22].style.display = "block";
            solutionText[23].style.display = "none";
            solutionText[24].style.display = "none";
            solutionText[20].style.display = "none";
            solutionText[21].style.display = "none";
        }
        if (btnNav[23].classList.contains('solutionIsActive')) {
            solutionText[23].style.display = "block";
            solutionText[24].style.display = "none";
            solutionText[20].style.display = "none";
            solutionText[21].style.display = "none";
            solutionText[22].style.display = "none";
        }
        if (btnNav[24].classList.contains('solutionIsActive')) {
            solutionText[24].style.display = "block";
            solutionText[20].style.display = "none";
            solutionText[21].style.display = "none";
            solutionText[22].style.display = "none";
            solutionText[23].style.display = "none";
        }
        if (btnNav[25].classList.contains('solutionIsActive')) {
            solutionText[25].style.display = "block";
            solutionText[26].style.display = "none";
            solutionText[27].style.display = "none";
            solutionText[28].style.display = "none";
            solutionText[29].style.display = "none";
        }
        if (btnNav[26].classList.contains('solutionIsActive')) {
            solutionText[26].style.display = "block";
            solutionText[27].style.display = "none";
            solutionText[28].style.display = "none";
            solutionText[29].style.display = "none";
            solutionText[25].style.display = "none";
        }
        if (btnNav[27].classList.contains('solutionIsActive')) {
            solutionText[27].style.display = "block";
            solutionText[28].style.display = "none";
            solutionText[29].style.display = "none";
            solutionText[25].style.display = "none";
            solutionText[26].style.display = "none";
        }
        if (btnNav[28].classList.contains('solutionIsActive')) {
            solutionText[28].style.display = "block";
            solutionText[29].style.display = "none";
            solutionText[25].style.display = "none";
            solutionText[26].style.display = "none";
            solutionText[27].style.display = "none";
        }
        if (btnNav[29].classList.contains('solutionIsActive')) {
            solutionText[29].style.display = "block";
            solutionText[26].style.display = "none";
            solutionText[27].style.display = "none";
            solutionText[28].style.display = "none";
            solutionText[29].style.display = "none";
        }
    });
});





