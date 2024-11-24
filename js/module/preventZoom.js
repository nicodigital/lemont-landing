function prevenZoom(){
  document.addEventListener('wheel', function(event) {
    if (event.ctrlKey) {
      event.preventDefault();
      // console.log("No puedes hacer zoom!");
    }
  }, { passive: false });
}

export default prevenZoom