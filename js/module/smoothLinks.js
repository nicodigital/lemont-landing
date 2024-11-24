/*///////////////////////////////////////////////////////////////////*/
/*///////////////////////// SMOOTH SCROLL ///////////////////////////*/
/*///////////////////////////////////////////////////////////////////*/

function smoothScroll() {

  let btnSmooth = document.querySelectorAll('.smooth');

  btnSmooth.forEach(btn => {

    let btnTarget = btn.getAttribute('href');
    let offset_top = btn.dataset.offset;

    function click_smooth(btnTarget, offset_top) {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        Jump(btnTarget, {
          offset: - offset_top
        });
      });
    }

    click_smooth(btnTarget, offset_top);

  });

}

export default smoothScroll;