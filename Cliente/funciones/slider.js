const items = document.querySelectorAll('.imagen');
const itemCount = items.length;
let count = 0;

function showNextItem() {
    items[count].classList.remove('active');

    if (count < itemCount - 1) {
        count++;
    } else {
        count = 0;
    }

    items[count].classList.add('active');
}

function keyPress() {

    showNextItem();

}

setInterval(keyPress, "4000");