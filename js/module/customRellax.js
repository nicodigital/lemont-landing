import Rellax from './rellax.min.js'

function customRellax (container = document) {
  const getRellax = container.querySelector('.rellax')
  if (getRellax) {
    // Destruir la instancia existente si la hay
    if (window.rellaxInstance) {
      window.rellaxInstance.destroy()
    }
    // Crear nueva instancia
    window.rellaxInstance = new Rellax('.rellax', {
      center: true
    })
  }
}

export default customRellax
