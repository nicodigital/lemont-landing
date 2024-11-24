function modal () {
  const html = document.querySelector('html')
  const modaLinks = document.querySelectorAll('.open-modal')
  const btnClose = document.querySelectorAll('.modal .close')
  const allModals = document.querySelectorAll('.modal')
  // console.log(btnClose);

  function closeModal (html, modal) {
    html.dataset.modal = 'off'
    modal.dataset.show = 'off'
  }

  // Función para manejar el clic fuera del elemento
  function handleClickOutside (html, modal, modalContent, modalType, event) {
    if (!modalContent.contains(event.target)) {
      // console.log('Se hizo clic fuera del elemento.');

      if (modalType === 'gallery') {
        setTimeout(() => gallerySwiper.destroy(), 1000)
      }

      closeModal(html, modal)
    }
  }

  modaLinks.forEach((btnModal) => {
    btnModal.onclick = (e) => {
      e.preventDefault()

      /* open modal */
      const modaLink = btnModal.dataset.modal

      const modal = document.querySelector(
        '.modal[data-modal=' + modaLink + ']'
      )

      const modalType = modal.dataset.type
      html.dataset.modal = 'on'
      modal.dataset.show = 'on'

      /* video play */
      if (modalType === 'video') {
        const modalVideo = modal.querySelector('video')
        modalVideo.play()
        modal.addEventListener('click', (e) => {
          modalVideo.pause()
        })
      }

      /* iframe play */
      if (modalType === 'iframe') {
        const modalIframe = modal.querySelector('iframe')
        const modalIframeSrc = modalIframe.dataset.src
        modalIframe.set('src', modalIframeSrc)
        modal.addEventListener('click', (e) => {
          modalVideo.pause()
        })
      }
    } // click
  })

  // Cerrar Modal al clickear fuera del contenido
  allModals.forEach((modal) => {
    modal.addEventListener('click', (event) => {
      const modalContent = modal.querySelector('.modal-box')
      const modalType = modal.dataset.type
      handleClickOutside(html, modal, modalContent, modalType, event)
    })
  })

  // Cerrar Modal al clickear el botón cerrar
  if (btnClose) {
    btnClose.forEach((close) => {
      close.addEventListener('click', (e) => {
        e.preventDefault()

        const thisModal = close.closest('.modal')

        thisModal.dataset.show = 'off'

        setTimeout(() => {
          html.dataset.modal = 'off'
        }, 300)
      })
    })
  } // btnClose
}

export default modal
