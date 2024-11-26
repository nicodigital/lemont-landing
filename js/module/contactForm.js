function contactForm (container = document) {
  const form = container.querySelector('#sheetdb-form')

  if (form) {
    const SPARK_ID = 'WYTGf3H3i'
    const SHEETDB = 'https://sheetdb.io/api/v1/bssql5iq0d9pw'
    let notices, from, subject

    const protocolo = window.location.protocol
    const dominio = window.location.hostname
    const baseURL = protocolo + '//' + dominio
    const AJAX_URL = 'https://submit-form.com/' + SPARK_ID

    const result = container.querySelector('#result')
    const loader = container.querySelector('.loader')

    // Form fields
    const lang = form.querySelector('[name=lang]')
    const name = form.querySelector('[name=name]')
    const email = form.querySelector('[name=email]')
    const phone = form.querySelector('[name=phone]')
    const message = form.querySelector('[name=message]')
    const btn_submit = form.querySelector('[type=submit]')

    // Validation regex
    const nameRegex = /^[A-Za-z]+ [A-Za-z]+$/
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
    const phoneRegex = /^\+\d{0,3}(?:\s?\d{1,3}){1,4}$|^\d{8,9}$/
    const messageRegex = /^.{16,}$/ // min 16 caracteres

    /* /////////////////// FROM & SUBJECT //////////////////// */
    function formatDateTime () {
      const now = new Date()
      const day = String(now.getDate()).padStart(2, '0')
      const month = String(now.getMonth() + 1).padStart(2, '0')
      const year = now.getFullYear()
      const hours = String(now.getHours()).padStart(2, '0')
      const minutes = String(now.getMinutes()).padStart(2, '0')
      return `${day}-${month}-${year} | ${hours}:${minutes} hs`
    }

    from = 'LE MONT'
    subject = 'Consulta desde LE MONT — ' + formatDateTime()

    /* ///////////////////// NOTICES /////////////////////// */
    notices = {
      success: lang.value === 'en'
        ? 'Thank you for contacting us. We will get back to you shortly.'
        : 'Gracias por escribirnos. En breve nos pondremos en contacto con usted.',
      error: lang.value === 'en'
        ? 'Error. Please try again.'
        : 'Error. Por favor, intenta de nuevo.'
    }

    /* ////////////////// VALIDACIÓN /////////////////// */
    function validField (field, regex) {
      if (!field || !field.value) return false
      const isValid = regex.test(field.value.trim())
      field.classList.toggle('invalid', !isValid)
      return isValid
    }

    function checkForm () {
      const isNameValid = validField(name, nameRegex)
      const isEmailValid = validField(email, emailRegex)
      const isPhoneValid = validField(phone, phoneRegex)
      const isMessageValid = validField(message, messageRegex)

      const isFormValid = isNameValid && isEmailValid && isPhoneValid && isMessageValid

      btn_submit.disabled = !isFormValid

      return isFormValid
    }

    /* ////////////////// EVENT LISTENERS /////////////////// */
    const debounce = (fn, delay) => {
      let timeoutId
      return function (...args) {
        clearTimeout(timeoutId)
        timeoutId = setTimeout(() => fn.apply(this, args), delay)
      }
    }

    const debouncedCheck = debounce(() => {
      checkForm()
    }, 300)

    // Agregar event listeners para validación en tiempo real
    ;[name, email, phone, message].forEach(field => {
      if (field) {
        ['input', 'blur', 'change'].forEach(eventType => {
          field.addEventListener(eventType, debouncedCheck)
        })
      }
    })

    // Validar también cuando el mouse sale del formulario
    form.addEventListener('mouseleave', checkForm)

    /* ////////////////// OBTENER VALORES DE INPUTS /////////////////// */
    function getSelectedRadioValue (name) {
      const selected = form.querySelector(`input[name="${name}"]:checked`)
      return selected ? selected.value : ''
    }

    function getSelectedValue (name) {
      const select = form.querySelector(`select[name="${name}"]`)
      return select ? select.value : ''
    }

    /* ////////////////// SUBMIT /////////////////// */
    form.addEventListener('submit', async (e) => {
      e.preventDefault()

      const loader = container.querySelector('.loader')
      loader.style.display = 'block'

      if (checkForm()) {
        const formData = {
          name: name.value,
          email: email.value,
          phone: phone.value,
          property_type: getSelectedRadioValue('property_type'),
          price_range: getSelectedRadioValue('price_range'),
          contact_preference: getSelectedValue('contact_preference'),
          message: message.value
        }

        const json = JSON.stringify({
          ...formData,
          _email: {
            from,
            subject,
            template: {
              title: false,
              footer: false
            }
          }
        })

        let sheetdbSuccess = false
        let emailSuccess = false

        try {
          const [sheetdbResponse, emailResponse] = await Promise.allSettled([
            // SheetDB request
            fetch(SHEETDB, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json'
              },
              body: json
            }),
            // Email request
            fetch(AJAX_URL, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json'
              },
              body: json
            })
          ])

          // Verificar resultado de SheetDB
          if (sheetdbResponse.status === 'fulfilled') {
            const sheetData = await sheetdbResponse.value.json()
            sheetdbSuccess = sheetdbResponse.value.ok // Verifica solo si la respuesta fue exitosa
          }

          // Verificar resultado del email
          if (emailResponse.status === 'fulfilled') {
            emailSuccess = emailResponse.value.ok
          }

          // Manejar el resultado final
          if (sheetdbSuccess && emailSuccess) {
            loader.style.display = 'none'
            result.innerHTML = notices.success
            form.reset()
          } else {
            throw new Error('Error en el envío')
          }
        } catch (error) {
          console.error('Error:', error)
          result.innerHTML = notices.error
        } finally {
          loader.style.display = 'none'
          result.style.display = 'block'

          // Si todo fue exitoso, ocultar el mensaje después de 3 segundos
          if (sheetdbSuccess && emailSuccess) {
            setTimeout(() => {
              result.style.display = 'none'
            }, 3000)
          }
        }
      }
    })
  }
}

export default contactForm
