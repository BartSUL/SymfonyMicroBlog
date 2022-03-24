/*==================== SHOW MENU ====================*/
const showMenu = (toggleId, navId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId)

    // Validate that variables exist
    if(toggle && nav){
        toggle.addEventListener('click', () =>{
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu')
        })
    }
}

showMenu('nav-toggle','nav-menu')

/*==================== SWIPER JS ====================*/
let galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 0,
    slidesPerView: 0,
})

let galleryTop = new Swiper('.gallery-top', {
    effect: 'fade',
    loop: true,

    thumbs: {
      swiper: galleryThumbs
    }
})


/*==================== POPUP ====================*/
const btnOpenVideo = document.querySelectorAll('.menulinks__video-content')
const menulinksPopup = document.getElementById('popup')

function poPup(){
    menulinksPopup.classList.add('show-popup')
}
btnOpenVideo.forEach(b => b.addEventListener('click', poPup))

const btnCloseVideo = document.getElementById('popup-close')

btnCloseVideo.addEventListener('click', ()=> {
    menulinksPopup.classList.remove('show-popup')
})

/*==================== GSAP ANIMATION ====================*/
const controlImg = document.querySelectorAll('.controls__img')

function scrollAnimation(){
    gsap.from('.menulinks__subtitle', {opacity: 0, duration: .2, delay: .2, y: -20})
    gsap.from('.menulinks__title', {opacity: 0, duration: .3, delay: .3, y: -20})
    gsap.from('.menulinks__description', {opacity: 0, duration: .4, delay: .4, y: -20})
    gsap.from('.menulinks__button', {opacity: 0, duration: .5, delay: .5, y: -20})
    gsap.from('.menulinks__video-content', {opacity: 0, duration: .6, delay: .6, y: -20})

    menulinksPopup.classList.remove('show-popup')
}

controlImg.forEach(c => c.addEventListener('click', scrollAnimation))