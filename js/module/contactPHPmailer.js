function contactForm () {
  const baseURL = 'https://brits.com.uy/'
  const form = document.querySelector('#contact-form')
  const ajax_form_url = 'inc/sendForm.php'
  const result = document.getElementById('result')

  if (form) {
    const name = form.querySelector('[name=name]')
    const email = form.querySelector('[type=email]')
    const phone = form.querySelector('[name=phone]')
    const message = form.querySelector('[name=message]')
    const btn_submit = form.querySelector('[type=submit]')

    const nameRegex = /^[A-Za-z]+ [A-Za-z]+$/
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
    const phoneRegex = /^\+\d{0,3}(?:\s?\d{1,3}){1,4}$|^\d{8,9}$/
    const messageRegex = /^.{16,}$/ // min 16 caracteres

    /* ////////////////// CAPTCHA /////////////////// */

    // function captcha(get) {

    //   const operadores = ['+', '-', '*'];
    //   const num1 = Math.floor(Math.random() * 10);
    //   const num2 = Math.floor(Math.random() * 10);
    //   const operador = operadores[Math.floor(Math.random() * operadores.length)];

    //   let result;

    //   switch (operador) {
    //     case '+':
    //       result = num1 + num2;
    //       break;
    //     case '-':
    //       result = num1 - num2;
    //       break;
    //     case '*':
    //       result = num1 * num2;
    //       break;
    //   }

    //   form.querySelector('#captcha').set('data-val', result);

    //   if (get == 'operation') {
    //     return `${num1} ${operador} ${num2} = `;
    //   } else {
    //     return result;
    //   }

    // }

    // const setCaptcha = document.querySelector('#captcha');
    // setCaptcha.value = captcha('operation');

    /* ////////////////// TEMPORIZADORES /////////////////// */
    // Definir una variable para el temporizador de retraso
    let typingTimer

    // Tiempo de espera en milisegundos antes de ejecutar la validación
    const doneTypingInterval = 500 // 500 milisegundos (0.5 segundos)

    // Función para manejar el evento de entrada en el campo
    function handleInput (field, regex) {
      // Limpiar el temporizador existente
      clearTimeout(typingTimer)

      // Comenzar un nuevo temporizador
      typingTimer = setTimeout(function () {
        // Ejecutar la validación después del tiempo de espera
        validField(field, regex)
      }, doneTypingInterval)
    }

    // function handleCaptcha() {
    //     // Limpiar el temporizador existente
    //     clearTimeout(typingTimer);

    //     // Comenzar un nuevo temporizador
    //     typingTimer = setTimeout(function() {
    //         // Ejecutar la validación después del tiempo de espera
    //         checkForm()
    //     }, doneTypingInterval);
    // }

    /* ////////////////// VALIDAR /////////////////// */

    function validField (field, regex) {
      const field_val = field.value

      // if ( !regex.test(field_val) ) {
      if (!field_val.match(regex)) {
        field.classList.add('invalid')
        return false
      }

      field.classList.remove('invalid')
      return true
    }

    /* ////////////////// CHECK FORM /////////////////// */
    function checkForm () {
      let formStatus = ''
      // let captchaPass = false;

      // const captcha = form.querySelector('#captcha').dataset.val;
      // const captchaResult = form.querySelector('#captchaResult');
      // console.log( captchaResult+' = '+ captcha );

      // if (captchaResult.value === captcha) {
      //   captchaPass = true;
      //   captchaResult.classList.remove('invalid');
      // } else {
      //   captchaResult.classList.add('invalid');
      // }

      // if (validField(name, nameRegex) && validField(email, emailRegex) && validField(phone, phoneRegex) && validField(message, messageRegex) && captchaPass) {
      if (validField(name, nameRegex) && validField(email, emailRegex) && validField(phone, phoneRegex) && validField(message, messageRegex)) {
        btn_submit.disabled = false
        formStatus = true
      } else {
        btn_submit.disabled = true
        formStatus = false
      }

      return formStatus
    }

    /* ////////////////// EVENT HANDLING /////////////////// */

    name.addEventListener('input', function () {
      handleInput(name, nameRegex)
    })

    email.addEventListener('input', function () {
      handleInput(email, emailRegex)
    })

    phone.addEventListener('input', function () {
      handleInput(phone, phoneRegex)
    })

    message.addEventListener('input', function () {
      handleInput(message, messageRegex)
    })

    // form.querySelector('#captchaResult').addEventListener('input', function() {
    //     handleCaptcha();
    // });

    form.onchange = () => {
      checkForm()
    }

    /* ////////////////// SUBMIT /////////////////// */

    form.addEventListener('submit', async (e) => {
      e.preventDefault()

      const loader = document.querySelector('.loader')
      loader.style.display = 'block'

      if (checkForm()) {
        const formData = new FormData(form)
        const object = Object.fromEntries(formData)
        const json = JSON.stringify(object)

        fetch(ajax_form_url, {

          method: 'POST',
          credentials: 'same-origin',
          mode: 'no-cors',
          headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded'
          }),
          body: 'name=' + name.value +
              '&email=' + email.value +
              '&phone=' + phone.value +
              '&message=' + message.value
          // '&recaptcha_response=' + recaptcha_response
        })
          .then(function (response) {
            //   return response.text;
            return response.json()
          })
          .then(function (content) {
            loader.style.display = 'none'

            name.value = ''
            email.value = ''
            phone.value = ''
            message.value = ''

            window.location.href = baseURL + 'gracias'
          }).catch(function (error) {
            console.log(JSON.stringify(error))
            result.innerHTML = '😭 Algo no ha funcionado bien.'
          })
      }
    })
  }
}

export default contactForm
