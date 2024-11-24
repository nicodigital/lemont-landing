function switchPageFade() {

  const switch_page = document.querySelectorAll('.switch-page');

  switch_page.forEach(item => {

    item.addEventListener('click', (e) => {
      e.preventDefault();

      let curr_link = item.href;

      body.classList.remove('fade-in');
      body.classList.add('fade-out');

      setTimeout(window.location.href = curr_link, 500)

    })

  })
}

export default switchPageFade