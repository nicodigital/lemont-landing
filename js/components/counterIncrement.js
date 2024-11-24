import { CountUp } from 'countUp.js'
// En caso de querer ejecutarlo en el footer, debemos
// darle una ruta relativa
// import { CountUp } from './countUp.min.js'

function counterIncrement () {
  const counterSection = document.querySelector('#counter')

  function animateCounters () {
    const counters = document.querySelectorAll('.counter-num')

    counters.forEach(counter => {
      const target = +counter.getAttribute('data-target')
      new CountUp(counter, target, {
        decimalPlaces: '',
        separator: '.',
        useGrouping: true
      }).start()
    })
  }

  // Verificar si el navegador soporta Intersection Observer
  if ('IntersectionObserver' in window && counterSection) {
    // console.log('Intersection Observer es soportado')

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
        //   console.log('Elemento intersectando')
        //   animateCounters()
          setTimeout(animateCounters, 300)
          observer.unobserve(entry.target)
        }
      })
    }, {
      threshold: 0,
      rootMargin: '0px'
    })

    // Verificar si el elemento ya está visible
    const rect = counterSection.getBoundingClientRect()
    const isVisible = rect.top >= 0 &&
                     rect.left >= 0 &&
                     rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                     rect.right <= (window.innerWidth || document.documentElement.clientWidth)

    if (isVisible) {
      console.log('Elemento ya visible al cargar')
      //   animateCounters()
      setTimeout(animateCounters, 300)
    } else {
      console.log('Iniciando observación del elemento')
      observer.observe(counterSection)
    }
  } else {
    // Fallback: si no hay soporte o no se encuentra el elemento
    console.log('Usando fallback')
    setTimeout(animateCounters, 300)
    // animateCounters()
  }
}

export default counterIncrement
