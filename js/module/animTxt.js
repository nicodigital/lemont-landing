function animTxt() {

  let delayIn = 0;
  let delayOut = 2800;
  let delayPhrase = -2800;
  let anim_phrases = document.querySelectorAll('.txt-animation .txt');

  anim_phrases.forEach( phrase => {

    let anim_words = phrase.querySelectorAll('.txt-animation span');

    delayPhrase = delayPhrase + 2800;

    function animWords() {

      anim_words.forEach( anim_txt => {

        delayIn = delayIn + 200;
        delayOut = delayOut + 200;

        function animTxtIn() {
          anim_txt.classList.add('anim-up')
        }
        setTimeout(animTxtIn, delayIn);

        if( !phrase.classList.contains('txt-end') ){

          function animTxtOut() {
            anim_txt.classList.add('anim-down')
          }
          setTimeout(animTxtOut, delayOut);

        }

      })

    }

    setTimeout(animWords, delayPhrase)

  })

}

export default animTxt;