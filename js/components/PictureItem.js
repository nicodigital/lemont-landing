function PictureItem() {

  class PictureItem extends HTMLElement {
    constructor() {
      super();

      // Obtén los atributos
      const WEBP = this.getAttribute("webp");
      const IMG = this.getAttribute("img");
      const LAZY = this.getAttribute("lazy") === "false" ? "" : "loading='lazy'";

      // Función para comprobar la existencia del archivo WEBP
      const checkWebPExists = async (url) => {
        if (!url) return false;
        try {
          const response = await fetch(url, { method: 'HEAD' });
          return response.ok;
        } catch (error) {
          console.error('Error checking WEBP file:', error);
          return false;
        }
      };

      // Función para obtener las dimensiones de la imagen
      const getImageDimensions = (url) => {
        return new Promise((resolve, reject) => {
          const img = new Image();
          img.onload = () => {
            resolve({ width: img.width, height: img.height });
          };
          img.onerror = (error) => {
            reject(new Error(`Failed to load image: ${url}`));
          };
          img.src = url;
        });
      };

      // Detecta el tipo de imagen
      const getImageType = (url) => {
        const extension = url.split('.').pop().toLowerCase();
        switch (extension) {
          case 'jpg':
          case 'jpeg':
            return 'image/jpeg';
          case 'png':
            return 'image/png';
          default:
            return '';
        }
      };

      // Inicializa el componente
      const init = async () => {
        try {
          const [webpExists, { width, height }] = await Promise.all([
            checkWebPExists(WEBP),
            getImageDimensions(IMG)
          ]);
          const imgType = getImageType(IMG);

          let html = `<picture>`;
          if (webpExists) {
            html += `<source srcset='${WEBP}' type='image/webp'>`;
          }
          html += `
            <source srcset='${IMG}' type='${imgType}'>
            <img src='${IMG}' ${LAZY} decoding='async' width='${width}' height='${height}' />
          </picture>`;

          this.innerHTML = ''; // Limpia el contenido original del elemento
          this.insertAdjacentHTML("beforeend", html);
        } catch (error) {
          console.error('Error initializing PictureItem:', error);
        }
      };

      init();
    }
  }

  customElements.define("picture-item", PictureItem);

}

export default PictureItem;
