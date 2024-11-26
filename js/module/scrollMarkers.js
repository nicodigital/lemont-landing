function scrollMarkers (device_data) {
  // console.log(device_data)
  const body = device_data.body
  const footer = device_data.footer
  const isDesktop = device_data.isDesktop
  const isMobile = device_data.isMobile
  const isTablet = device_data.isTablet
  const platform = device_data.platform

  function setMarkers () {
    const scrollPosition = window.scrollY

    // Opciones para el IntersectionObserver
    const options = {
      root: null, // Usar el viewport como área de observación
      rootMargin: '0px', // Margen adicional alrededor del área de observación
      threshold: 0.5 // Porcentaje del elemento que debe estar visible para activar la función de callback
    }

    // Función de callback que se ejecuta cuando el elemento entra en la pantalla
    const callback = function (entries, observer) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // console.log('Elemento está ahora en pantalla!');
          body.setAttribute('data-scroll', 'bottom')
          // Puedes realizar aquí las acciones que desees cuando el elemento entre en pantalla
          // Por ejemplo, cambiar su estilo, cargar contenido adicional, etc.
        } else {
          if (scrollPosition < 100) {
            body.setAttribute('data-scroll', 'top')
          } else {
            body.setAttribute('data-scroll', 'down')
          }
        }
      })
    }

    // Crear una instancia de IntersectionObserver con la función de callback y opciones
    const observer = new IntersectionObserver(callback, options)
    // Observa el elemento target
    observer.observe(footer)
  }

  let lastScrollTop = ''

  function smart_menu () {
    const st = window.scrollY

    if (st > lastScrollTop) {
      body.dataset.stack = 'off'
    } else {
      body.dataset.stack = 'on'
    }

    lastScrollTop = st
  }

  window.onscroll = (e) => {
    setMarkers()

    if (platform != 'ios' && isMobile === true) {
      smart_menu()
    } else if (isDesktop === true || isTablet === true) {
      smart_menu()
    }
  }
}

export default scrollMarkers
