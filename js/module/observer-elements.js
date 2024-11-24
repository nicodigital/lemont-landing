/*/////////////////////////////////////////////////////////////////////*/
/*/////////////////////// OBSERVER ELEMENT ////////////////////////////*/
/*/////////////////////////////////////////////////////////////////////*/

let all_obs_elements = document.querySelectorAll('.observe-me');

if( check(all_obs_elements) ){

	const loadElement = (enter, observer) => {
		// console.log(enter)
		// console.log(observer)

		enter.forEach((enter) => {
			if(enter.isIntersecting){
				enter.target.classList.add('in');
			} else {
				enter.target.classList.remove('in');
			}
		});
	}

	const observer = new IntersectionObserver(loadElement, {
		root: null,
		rootMargin: '0px 0px 0px 0px',
		threshold: 1.0
	});

	all_obs_elements.forEach( anim => {
		observer.observe(anim);
	});

}