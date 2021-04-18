//: Gestion de la suppression via un confirm utilisateur

let supprimer = document.querySelectorAll('.supprimer');

let message2 = document.querySelector('.message2');

for(let valeur of supprimer) {

    valeur.addEventListener('click',function(event)
    {
        let action = confirm('Voulez vous vraiment supprimer cette ligne ?');
        if (!action) {
            event.preventDefault();
        }
    });
};

//: Gestion de l'affichage des photos en full resolution

let photos = document.querySelectorAll('tbody tr td:nth-child(3) a');
let modal = document.querySelector('.modal');
let modalImg = document.querySelector('.modal img');


for(let valeur of photos) {
    valeur.addEventListener('click',function(event){
        event.preventDefault();
        modal.classList.replace('d-none','d-block');
        modalImg.src = valeur.attributes[0].value;  
    })
}

modalImg.addEventListener('click',function(event){
    modal.classList.replace('d-block','d-none');
    event.preventDefault;
})

//: Timer sur le message de confirmation de modification

let message = document.querySelector('.message');

if (message.classList.contains('d-block')) {
    setTimeout(function(){
        message.classList.replace('opacity-5', 'opacity-0');
    }
    ,2800);

    setTimeout(function(){
        message.classList.replace('d-block','d-none');
    }
    ,3000);
} 

else {
    message.classList.replace('d-none','d-block');
}


if (message2.classList.contains('d-block')) {
    setTimeout(function(){
        message2.classList.replace('opacity-5', 'opacity-0');
    }
    ,2800);

    setTimeout(function(){
        message2.classList.replace('d-block','d-none');
    }
    ,3000);
} 

else {
    message2.classList.replace('d-none','d-block');
}
