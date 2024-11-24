/*/////////////////////////////////////////////////////////////////////*/
/*///////////////////////// GET URL PARAMS ////////////////////////////*/
/*/////////////////////////////////////////////////////////////////////*/

function getUrlParams(name) {
	name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
	var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
	var results = regex.exec(location.search);
	return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// getlang = getUrlParams('lang');
export default getUrlParams