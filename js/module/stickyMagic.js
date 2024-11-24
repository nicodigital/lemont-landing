function stickyMagic(){

    const stickySections = document.querySelectorAll('.sticky-magic');

    stickySections.forEach( magic =>{
        const magicSlides = magic.querySelectorAll('img');
        const magicCount = magicSlides.length  * 100;
        magic.style.height = magicCount+'vh';
    })

    // Función para cambiar la opacidad de las imágenes dentro de todos los section .sticky
    function toggleImageOpacity() {

        function updateImageOpacity(stickySection) {
            var images = stickySection.querySelectorAll('img');
            var scrollDistance = window.innerHeight;
            var scrollPosition = window.scrollY;

        // Calcular el índice de la imagen visible
            var index = Math.floor((scrollPosition - stickySection.offsetTop) / scrollDistance);

        // Aplicar la opacidad adecuada a cada imagen
            images.forEach(function(img, i) {
                img.style.opacity = i === index ? '1' : '0';
            });
        }

    // Agregar el evento de scroll a cada section .sticky
        stickySections.forEach(function(stickySection) {
            window.addEventListener('scroll', function() {
                updateImageOpacity(stickySection);
            });
        });
    }

// Llama a la función cuando el documento esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        toggleImageOpacity();
    });

}

export default stickyMagic