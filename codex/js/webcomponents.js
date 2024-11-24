class UserCard extends HTMLElement {

  constructor() {
    super();

    /* Get attributes */
    const NAME = this.getAttribute('name');

    /* Create HTML */
    const HTML = /*html*/`<div class="card">
      <img src="https://avatars.githubusercontent.com/ManzDev&size=128" alt="" />
      <span>${NAME}</span>
    </div>`;

    this.insertAdjacentHTML('beforeend', HTML);
    
  } 

}

customElements.define('user-card', UserCard);