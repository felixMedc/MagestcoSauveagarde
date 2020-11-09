let spanBefore = document.getElementById('click-before');
let spanAfter = document.getElementById('click-after');
let divCommentary = document.getElementsByClassName('commentary-wrapper');
let ElementNumber = 0;

// simule le click d'une souris
function clickButton() { 
    document.getElementById('click-after').click(); 
} 
setInterval(clickButton, 3000); 


if (window.innerWidth > 1024) {

    spanAfter.addEventListener('click', () => {

        ElementNumber++

        for (let PositionElement of divCommentary) {
            if (ElementNumber == 0) {
                PositionElement.style.left = "0%";
            }
            if (ElementNumber == 1) {
                PositionElement.style.left = "-33.33%";
            }
            if (ElementNumber == 2) {
                PositionElement.style.left = "-66.66%";
            }
            if (ElementNumber >= 3) {
                ElementNumber = 0;
                PositionElement.style.left = "0%";
            }
        }
    });

    spanBefore.addEventListener('click', () => {
        ElementNumber--

        for (let PositionElement of divCommentary) {
            if (ElementNumber == 3) {
                PositionElement.style.left = "0%";
            }
            if (ElementNumber == 2) {
                PositionElement.style.left = "-66.66%";
            }
            if (ElementNumber == 1) {
                PositionElement.style.left = "-33.33%";
            }
            if (ElementNumber <= 0) {
                ElementNumber = 3;
                PositionElement.style.left = "0%";
            }
        }

    });
}
else if (window.innerWidth < 1024) {

    spanAfter.addEventListener('click', () => {
        ElementNumber++

        for (let PositionElement of divCommentary) {
            if (ElementNumber == 0) {
                PositionElement.style.left = "0%";
            }
            if (ElementNumber == 1) {
                PositionElement.style.left = "-100%";
            }
            if (ElementNumber == 2) {
                PositionElement.style.left = "-200%";
            }
            if (ElementNumber == 3) {
                PositionElement.style.left = "-300%";
            }
            if (ElementNumber == 4) {
                PositionElement.style.left = "-400%";
            }
            if (ElementNumber > 4) {
                ElementNumber = 0;
                PositionElement.style.left = "0%";
            }
        }
    });

    spanBefore.addEventListener('click', () => {
        ElementNumber--

        for (let PositionElement of divCommentary) {
            if (ElementNumber == 0) {
                PositionElement.style.left = "0%";
            }
            if (ElementNumber == 1) {
                PositionElement.style.left = "-100%";
            }
            if (ElementNumber == 2) {
                PositionElement.style.left = "-200%";
            }
            if (ElementNumber == 3) {
                PositionElement.style.left = "-300%";
            }
            if (ElementNumber == 4) {
                PositionElement.style.left = "-400%";
            }
            if (ElementNumber < 0) {
                ElementNumber = 4;
                PositionElement.style.left = "-400%";
            }
        }
    });
};