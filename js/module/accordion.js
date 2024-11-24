function accordion () {
  const headings = document.querySelectorAll('.accordion-heading')
  const triggers = []
  const accordionContents = document.querySelectorAll('.accordion-copy')
  const copyOpenClass = 'accordion-copy--open'
  const multiselect = false

  headings.forEach((h, i) => {
    const btn = h.querySelector('button')
    triggers.push(btn)

    const target = h.nextElementSibling

    btn.onclick = () => {
      const expanded = btn.getAttribute('aria-expanded') === 'true'
      if (expanded) {
        closeItem(target, btn)
      } else {
        openItem(target, btn)
      }
    }
  })

  function closeAllExpandedItems () {
    const expandedTriggers = triggers.filter(
      (t) => t.getAttribute('aria-expanded') === 'true'
    )
    const expandedCopy = Array.from(accordionContents).filter((c) =>
      c.classList.value.includes(copyOpenClass)
    )
    expandedTriggers.forEach((trigger) => {
      trigger.setAttribute('aria-expanded', false)
    })
    expandedCopy.forEach((copy) => {
      copy.classList.remove(copyOpenClass)
      copy.style.maxHeight = 0
      copy.style.padding = 'var(--content-padding)'
    })
  }

  function closeItem (target, btn) {
    if (multiselect) {
      btn.setAttribute('aria-expanded', false)
      target.classList.remove(copyOpenClass)
      target.style.maxHeight = 0
      target.style.padding = '0'
    } else {
      closeAllExpandedItems()
    }
  }

  function openItem (target, btn) {
    if (!multiselect) {
      closeAllExpandedItems()
    }

    const copyH = target.scrollHeight + 40

    btn.setAttribute('aria-expanded', true)
    target.classList.add(copyOpenClass)
    target.style.maxHeight = copyH + 'px'
    target.style.padding = 'var(--content-padding)'
  }

  // Habilitamos esto si queremos el primer item abierto
  // setTimeout(() => triggers[0].click(), 750);
}

export default accordion

// document.addEventListener("DOMContentLoaded", accordion);
