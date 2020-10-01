let spanBefore = document.getElementById('click-before');
let spanAfter = document.getElementById('click-after');
let divCommentary = document.getElementsByClassName('commentary');
let ElementNumber = 0;

spanAfter.addEventListener('click', () => {
    ElementNumber++
    for (let PositionElement of divCommentary) {
        if (ElementNumber == 0) {
            PositionElement.style.left = "0px";
        }
        if (ElementNumber == 1) {
            PositionElement.style.left = "-33.33%";
        }
        if (ElementNumber == 2) {
            PositionElement.style.left = "-66.66%";
        }
        if (ElementNumber == 3) {
            ElementNumber = 0;
            PositionElement.style.left = "0px";
        }
    }
});

spanBefore.addEventListener('click', () => {
    ElementNumber--
    for (let PositionElement of divCommentary) {
        if (ElementNumber == 0) {
            PositionElement.style.left = "0px";
        }
        if (ElementNumber == 1) {
            PositionElement.style.left = "33.33%";
        }
        if (ElementNumber == 2) {
            PositionElement.style.left = "66.66%";
        }
        if (ElementNumber == -1) {
            ElementNumber = 0;
            PositionElement.style.left = "0px";
        }
    }
});
