<div class="container row py-8">
	<div class="col-[1/13] text-center mb-4">
		<h2 class="h1">Buttons</h2>
	</div>

	<div class="col-[1/13] flex justify-center gap-4">
		<a href="#" class="btn-solid"> btn-solid</a>
		<a href="#" class="btn-outline"> btn-outline</a>
	</div>
</div>

<script>
	let all_buttons = document.querySelectorAll('[class*="btn-"]');

	all_buttons.forEach(btn => {

		btn.addEventListener('click', (e) => {
			e.preventDefault;
			let clases = btn.textContent;

			/* Copy the text inside the text field */
			navigator.clipboard.writeText(clases);

			/* Alert the copied text */
			alert(' ¡Copiado!');

		});

	});
</script>

