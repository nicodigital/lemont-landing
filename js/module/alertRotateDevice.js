/*/////////////////////////////////////////////////////////////////////*/
/*//////////////////// ALERT GIRAR DISPOSITIVO ////////////////////////*/
/*/////////////////////////////////////////////////////////////////////*/

function alertRotateDevice( isDesktop, isBigTablet, isMobile  ) {

	if (!isDesktop) {

		function rotateDeviceHorizontal() {
			if (window.orientation === 0 || window.orientation === 180) {
				// Bloquear la orientación vertical
				alert("Por favor, gire su dispositivo para visualizar correctamente nuestro sitio.");
			}
		}

		function rotateDeviceVertical() {
			if (window.orientation === 90 || window.orientation === -90) {
				// Bloquear la orientación horizontal
				alert("Por favor, gire su dispositivo para visualizar correctamente nuestro sitio.");
			}
		}

		if (isBigTablet) {

			rotateDeviceHorizontal();

			window.addEventListener("orientationchange", function () {
				rotateDeviceHorizontal();
			});

		}

		if (isMobile && !isBigTablet) {

			rotateDeviceVertical()

			window.addEventListener("orientationchange", function () {
				rotateDeviceVertical()
			});

		}

	}

}


export default alertRotateDevice;
