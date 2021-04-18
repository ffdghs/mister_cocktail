let previous = document.querySelector('#prev');
let next = document.querySelector('#next');

let reglette = document.querySelector('.reglette');

let cards = document.querySelectorAll('.card2');

let overCocktails = document.querySelector('.cocktailsFamille')

DEPL = 248;

let regletteWidth = reglette.clientWidth;
let deplacement = 100/(regletteWidth/DEPL);
console.log(deplacement);

function order() {
    for (let i = 0; i < cards.length; i++) {
        cards[i].style.order = i;
    }
}

order();
let compteur = 0;
let compteur2 = 0;

reglette.style.left = '0px'

overCocktails.addEventListener('mouseover',function(){
    next.classList.replace('d-none','d-flex');
});

overCocktails.addEventListener('mouseout',function(){
    next.classList.replace('d-flex','d-none');
});


next.addEventListener('click', function(){
    let timer = setInterval(function(){
        if (parseFloat(reglette.style.left) > -(deplacement)) {
            reglette.style.left = parseFloat(reglette.style.left) - 1.36266 + '%';
            console.log(reglette.style.left);
        }
        else{ 
            clearInterval(timer)
        }
    },5)

        // for (i = 0; i < cards.length; i++) {
        //         if (Math.abs(parseFloat(reglette.style.left)/DEPL) == parseFloat(cards[i].style.order)) {
        //             cards[i-1].style.order = parseFloat(cards[i-1].style.order) + cards.length;
        //         }

        

    setTimeout(function(){
        cards[compteur].style.order = parseFloat(cards[compteur].style.order) + cards.length;
        compteur++
        if (compteur == cards.length) {
            compteur = 0;
            order();
        }
        reglette.style.left = 0;
        

    },600);

    
});

previous.addEventListener('click', function(){
    cards[compteur2].style.order = parseFloat(cards[compteur2].style.order) - cards.length;
    reglette.style.left = parseFloat(reglette.style.left) + deplacement + '%';
    console.log(Math.abs(parseFloat(reglette.style.left)/DEPL));
        for (i = 0; i < cards.length; i++) {
                if (Math.abs(parseFloat(reglette.style.left)/DEPL) == parseFloat(cards[i].style.order)) {
                    cards[i-1].style.order = parseFloat(cards[i-1].style.order) - cards.length;
                }

        }

    setTimeout(function(){
        cards[compteur2].style.order = parseFloat(cards[compteur2].style.order) - cards.length;
        compteur2++
        if (compteur2 == cards.length) {
            compteur2 = 0;
            order();
        }
        // reglette.style.left = 0;
        

    },100);
});






