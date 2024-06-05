let userBox = document.querySelector(".user-menu li .account-box");

document.querySelector(".user-menu li").onclick = () =>{
  userBox.classList.toggle('active');
};

window.onscroll = () => {
    navbar.classList.remove('active');
    userBox.classList.remove('active');
}

$(document).ready(function(){
    $('.image-slider').slick({
        infinite: true,
        prevArrow:`<button type='button' class='slick-prev slick-arrow'><i class='fa fa-angle-left' aria-hidden='true'></i></button>`,
        nextArrow:`<button type='button' class='slick-next slick-arrow'><i class='fa fa-angle-right' aria-hidden='true'></i></button>`   
    });
  });
