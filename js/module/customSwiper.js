import Swiper from 'swiper'
import { EffectFade, Autoplay, Navigation, Pagination } from 'swiper/modules'

function customSwiper () {
  const swiper = new Swiper('.swiper', {
    modules: [EffectFade, Autoplay, Navigation, Pagination],
    spaceBetween: 0,
    // centeredSlides: true,
    loop: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false
    },
    speed: 750,
    // effect: "fade",
    // allowTouchMove: false
    // pagination: {
    // 	el: '.swiper-pagination',
    // 	clickable: true,
    // },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  })
}

export default customSwiper
