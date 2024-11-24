
let clickedItem = null;
let clickedItemIndex = null;
let clickedAnchor = null;

document.addEventListener('click', (event) => {
  const target = event.target.closest('a');

  if (target) {
    clickedItem = target;
    const allLinks = Array.from(document.querySelectorAll('a'));
    clickedItemIndex = allLinks.indexOf(target);

    // Obtiene el valor del href
    const href = target.getAttribute('href');

    // Extrae el anchor (si existe)
    if (href && href.includes('#')) {
      clickedAnchor = href.split('#')[1]; // Obtiene solo la parte después del '#'
    } else {
      clickedAnchor = null; // No hay anchor en el href
    }
  }
});

function getClickedItem() {
  return clickedItem;
}

function getClickedItemIndex() {
  return clickedItemIndex;
}

function getClickedAnchor() {
  return clickedAnchor;
}

export { getClickedItem, getClickedItemIndex, getClickedAnchor }
