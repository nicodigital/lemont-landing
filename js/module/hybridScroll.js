function hybridScroll(){

	const stickySections = [...document.querySelectorAll('.sticky')];

	stickySections.forEach( sticky =>{
		const stickyParent = sticky.closest('.sticky-parent');
		const stickySlides = [...stickyParent.querySelectorAll('.sticky-slide')];
		stickyParent.style.height = `${stickySlides.length}00vh`;
	})

	function transform(section){
		const offseTop = section.parentElement.offsetTop;
		const scrollSection = section.querySelector('.scroll-section');
		let percent = ((window.scrollY - offseTop) / window.innerHeight ) * 100;
		percent = percent < 0 ? 0 : percent > 400 ? 400 : percent;
		scrollSection.style.transform = `translate3d(${-(percent)}vw, 0, 0 )`;
	}

	window.addEventListener('scroll', (e) =>{

		for ( let i = 0; i < stickySections.length; i++ ){
			transform(stickySections[i])
		}

	})

}

export default hybridScroll