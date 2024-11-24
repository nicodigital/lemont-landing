function onScreen (selector, container = document) {
  const item = container.querySelector(selector)

  const observerOptions = {
    root: null, // viewport
    rootMargin: '0px',
    threshold: [0.16, 0.4] // 40% and 40%
  }

  const observerCallback = (entries) => {
    entries.forEach(entry => {
      if (entry.intersectionRatio > 0.16) {
        item.classList.add('active')
      }
      // else {
      // 		item.classList.remove('active');
      // }
    })
  }

  const observer = new IntersectionObserver(observerCallback, observerOptions)

  // Wait for the item to load before observing
  item.onload = () => observer.observe(item)

  // If the item is already cached and loaded
  if (item.complete) {
    observer.observe(item)
  }
}

export default onScreen
