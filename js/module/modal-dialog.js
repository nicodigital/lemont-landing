 function modal() {

    const BUTTONS = document.querySelectorAll(".open-modal");
    // const MODALS  = document.querySelectorAll("dialog");
    // console.log(Array.from(BUTTONS))

    function closeModal(modal){
        let modalClose = modal.querySelector(".close");
        modalClose.addEventListener("click", () => {
          modal.set("close", "true");
          modal.close();
      })
    }

    BUTTONS.forEach( button => {

      button.addEventListener("click", (e) => {
        e.preventDefault();

        const modal = button.getAttribute("href");
        let currModal = document.querySelector(`dialog[data-modal='${modal}']`);
        // console.log(currModal);

        currModal.showModal();
        closeModal(currModal);
      });

    });

 }

 export default modal