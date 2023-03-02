//menu burger

if (document.querySelector('.user')){
    const btnBurger = document.querySelector('.user');
    const burgerMenu = document.querySelector('.burgerMenu');

    btnBurger.addEventListener('click', () => {
        burgerMenu.classList.toggle('open');
    });


}
