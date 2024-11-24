const DEFAULT_CONFIG = {
  enableAutoScroll: true,
  enableAutoScrollMobile: false, // New parameter for mobile
  enableAutoScrollDesktop: true, // New parameter for desktop
  scrollOffset: 20,
  extraDelay: 50,
  useTransitionDuration: true,
  mobileBreakpoint: 768 // Breakpoint for mobile devices in pixels
}

function accordionNested (userConfig = {}) {
  const config = { ...DEFAULT_CONFIG, ...userConfig }

  // Function to check if device is mobile based on screen width
  const isMobile = () => window.innerWidth <= config.mobileBreakpoint

  // Modified scroll handling logic
  const shouldEnableScroll = () => {
    if (!config.enableAutoScroll) return false
    return isMobile() ? config.enableAutoScrollMobile : config.enableAutoScrollDesktop
  }

  // Rest of the initialization code remains the same
  document.querySelectorAll('.accordion > .accordion-item').forEach((el) => {
    const isExpanded = el.dataset.expanded === 'true'
    if (isExpanded) {
      expandItem(el)
    } else {
      collapseItem(el)
    }
  })

  const getTransitionDuration = (element) => {
    if (!config.useTransitionDuration) return 0

    const style = window.getComputedStyle(element)
    const duration = style.transitionDuration
    return duration.includes('ms')
      ? parseFloat(duration)
      : parseFloat(duration) * 1000
  }

  const scrollToElement = (element) => {
    if (!shouldEnableScroll()) return

    const rect = element.getBoundingClientRect()
    const absoluteTop = window.pageYOffset + rect.top

    window.scrollTo({
      top: absoluteTop - config.scrollOffset,
      behavior: 'smooth'
    })
  }

  const handleAutoScroll = (element) => {
    if (!shouldEnableScroll()) return

    const collapse = element.querySelector(':scope > .accordion-collapse')
    const transitionDuration = getTransitionDuration(collapse)
    const scrollDelay = transitionDuration + config.extraDelay

    setTimeout(() => scrollToElement(element), scrollDelay)
  }

  // Rest of the code remains unchanged
  document
    .querySelectorAll('.accordion > .accordion-item > .accordion-header')
    .forEach((header) => {
      header.addEventListener('click', () => {
        const currentAccordionItem = header.closest('.accordion-item')
        const isActive = header.classList.contains('active')

        if (isActive) {
          collapseItem(currentAccordionItem)
        } else {
          expandItem(currentAccordionItem)
          currentAccordionItem.parentElement
            .querySelectorAll(':scope > .accordion-item')
            .forEach((item) => {
              if (item !== currentAccordionItem) {
                collapseItem(item)
              }
            })

          handleAutoScroll(currentAccordionItem)
        }
      })
    })

  document.querySelectorAll('[data-toggle="collapse"]').forEach((button) => {
    const target = document.querySelector(button.dataset.target)
    if (button.getAttribute('aria-expanded') === 'true') {
      expandCollapse(target)
      button.classList.add('active')
    } else {
      target.style.maxHeight = null
    }

    button.addEventListener('click', () => toggleCollapse(button))
  })

  function expandItem (item) {
    const collapse = item.querySelector(':scope > .accordion-collapse')
    if (collapse) {
      collapse.style.maxHeight = collapse.scrollHeight + 'px'
      collapse.style.opacity = '1'
      item.querySelector(':scope > .accordion-header').classList.add('active')

      collapse.addEventListener('transitionend', function onTransitionEnd () {
        collapse.style.maxHeight = 'none'
        collapse.removeEventListener('transitionend', onTransitionEnd)
      })
    }
  }

  function collapseItem (item) {
    const collapse = item.querySelector(':scope > .accordion-collapse')
    if (collapse) {
      collapse.style.maxHeight = collapse.scrollHeight + 'px'
      collapse.offsetHeight
      collapse.style.maxHeight = '0'
      collapse.style.opacity = '0'
      item.querySelector(':scope > .accordion-header').classList.remove('active')
    }
  }

  function toggleCollapse (button) {
    const target = document.querySelector(button.dataset.target)
    const isExpanded = button.getAttribute('aria-expanded') === 'true'

    if (isExpanded) {
      collapseCollapse(target)
      button.setAttribute('aria-expanded', 'false')
      button.classList.remove('active')
    } else {
      expandCollapse(target)
      button.setAttribute('aria-expanded', 'true')
      button.classList.add('active')
    }
  }

  function expandCollapse (element) {
    element.style.maxHeight = element.scrollHeight + 'px'
    element.style.opacity = '1'
  }

  function collapseCollapse (element) {
    element.style.maxHeight = element.scrollHeight + 'px'
    element.offsetHeight
    element.style.maxHeight = '0'
    element.style.opacity = '0'
  }
}

export default accordionNested
