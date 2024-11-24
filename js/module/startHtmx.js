import htmx from 'htmx.org'

function startHtmx (container = document, animations) {
  if (htmx) {
    htmx.process(container)
  } else {
    console.error('HTMX is not defined')
  }

  // Ejecutar animaciones cuando HTMX carga nuevo contenido
  document.body.addEventListener('htmx:afterRequest', (event) => {
    // console.log("HTMX afterSettle event triggered");  // Log para depuración
    animations(container)

    // window.scrollTo(0, 0) // Activamos en caso de paginación
  })

  // Debugging HTMX
  // document.body.addEventListener('htmx:load', function (evt) {
  //   htmx.logAll()
  // })
}

export default startHtmx
