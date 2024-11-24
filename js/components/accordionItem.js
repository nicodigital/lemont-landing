function AccordionItem () {
  class AccordionItem extends HTMLElement {
    constructor () {
      super()

      // Obtén los atributos
      const title = this.getAttribute('title')
      const txt = this.innerHTML.trim() // Recupera el texto dentro de la etiqueta
      const expand = this.getAttribute('expand') || 'false'
      const copyStatus = expand == 'true' ? 'accordion-copy--open' : ''

      const html = /* html */
        `<div class="accordion-item">
            <h2 class="accordion-heading">
              <button class="accordion-trigger" aria-expanded="${expand}" >
                ${title} <span><span>Más info</span></span>
              </button>
            </h2>
            <div class="accordion-copy ${copyStatus}">${txt}</div>
        </div>`

      this.innerHTML = '' // Limpia el contenido original del elemento
      this.insertAdjacentHTML('beforeend', html)
    }
  }

  customElements.define('acc-item', AccordionItem)
}

export default AccordionItem
