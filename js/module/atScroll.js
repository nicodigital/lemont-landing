function atScroll( elemento, behavior ) {

  // Configura el Intersection Observer
  const opciones = {
    root: null, // Usar el viewport como raíz
    rootMargin: '0px',
    threshold: 0.1 // Ejecutar la función cuando el 10% del elemento es visible
  };

  const observer = new IntersectionObserver((entradas) => {
    entradas.forEach(entrada => {
      if (entrada.isIntersecting) {
        console.log("ejecutame");
        // El elemento está en pantalla
        behavior(); 
        observer.unobserve(entrada.target); // Deja de observar si solo necesitas que se ejecute una vez
      }
    });
  }, opciones);

  // Inicia la observación del elemento
  if (elemento) {
    observer.observe(elemento);
  }
}

export default atScroll