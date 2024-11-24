function SafariDeprecated() {

    // Verifica si el navegador es Safari
    var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

    if (isSafari) {
        // Extrae la versión de Safari del userAgent
        var safariVersionMatch = navigator.userAgent.match(/Version\/(\d+)\./);

        if (safariVersionMatch) {
            var safariVersion = parseInt(safariVersionMatch[1], 10);

            if (safariVersion < 16) {
                alert("Estás utilizando una versión muy antigua de Safari. Hemos desarrollando nuestro sitio web con los últimos standares, para lograr una mejor experiencia. Considera actualizar tu navegador, o utlizar otro, ya que este no es compatible con algunas funciones de nuestro sitio.");
            }
        }
    }
}

export default SafariDeprecated