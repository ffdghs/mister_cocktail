//: Modal ajout famille

let modal = document.querySelector('#divAjoutFam');

let ok = document.querySelector('#ok');

let closes = document.querySelectorAll('.closes');

let selectFamille = document.querySelector('#idFamille');

selectFamille.addEventListener('change',function(){
    if (selectFamille.value == 'new') {

        modal.classList.replace('d-none','d-block');
    }
})

ok.addEventListener('click',function(){
    modal.classList.replace('d-block','d-none');
})

closes[0].addEventListener('click',function(){
    modal.classList.replace('d-block','d-none');
})
closes[1].addEventListener('click',function(){
    modal.classList.replace('d-block','d-none');
})

//: Disparition du message de validation

let messages = document.querySelector('.messages');

if (messages.classList.contains('d-block')) {
    setTimeout(function(){
        messages.classList.replace('opacity-5', 'opacity-0');
    }
    ,4800);
    
    setTimeout(function(){
        messages.classList.replace('d-block','d-none');
    }
    ,4000);
} 

else {
    messages.classList.replace('d-none','d-block');
}

//: Disparition de la card 

let newCard = document.querySelector('.newCard');

if (newCard.classList.contains('d-flex')) {
    setTimeout(function(){
        newCard.classList.replace('opacity-5', 'opacity-0');
    }
    ,3800);
    
    setTimeout(function(){
        newCard.classList.replace('d-flex','d-none');
    }
    ,4000);
} 


//: Modal ajout ingrédient

let ajoutIngredient = document.querySelector('#creerIngredient');
let modalIngredient = document.querySelector('#divAjoutIngredient');

// ajoutIngredient.addEventListener('click',function(){
//     modalIngredient.classList.replace('d-none','d-block');
// })

// closes[2].addEventListener('click',function(){
//     modalIngredient.classList.replace('d-block','d-none');
// })
// closes[3].addEventListener('click',function(){
//     modalIngredient.classList.replace('d-block','d-none');
// })




let ok2 = document.querySelector('#ingredient');

let selectIngredient = document.querySelector('#listeIngredient');

selectIngredient.addEventListener('change',function(){
    if (selectIngredient.value == 'newIngredient') {

        modalIngredient.classList.replace('d-none','d-block');
    }
});

ok2.addEventListener('click',function(){
    modalIngredient.classList.replace('d-block','d-none');
});

closes[2].addEventListener('click',function(){
    modalIngredient.classList.replace('d-block','d-none');
});
closes[3].addEventListener('click',function(){
    modalIngredient.classList.replace('d-block','d-none');
});