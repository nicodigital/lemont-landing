function ModalItem () {

  class ModalItem  extends HTMLElement {
    constructor() {
      super();

      // Obtén los atributos
      const modal = this.getAttribute("data-modal") || "test";
      const type = this.getAttribute("data-type") || "";
      const show = this.getAttribute("data-show") || "off";
      const content = this.innerHTML.trim(); // Recupera el texto dentro de la etiqueta

      const html = /*html*/
        `<dialog class="modal" data-modal="${modal}" data-type="${type}" data-show="${show}" >
          <div class="close close-modal"></div>
          <div class="modal-box">${content}</div>
        </dialog>`;

      this.innerHTML = ''; // Limpia el contenido original del elemento
      this.insertAdjacentHTML("beforeend", html);
    }
  }

  customElements.define("modal-item", ModalItem );

}

export default ModalItem;
