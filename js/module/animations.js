function animations (container = document) {
  const observedElements = new Set()
  const animations = container.querySelectorAll('.anim')
  if (animations.length > 0) {
    let lastScrollY = 0

    const triggerAnim = (entries) => {
      entries.forEach((entry) => {
        const element = entry.target
        const delay = element.dataset.delay || 0
        const speed = element.dataset.speed + 's' || '1s'
        const once = element.dataset.once ?? 'false'

        const applyAnimation = () => {
          setTimeout(() => {
            element.style.animationDuration = speed
            element.classList.add('anim-on')
            if (once === 'true') {
              observedElements.add(element)
            }
          }, delay)
        }

        if (entry.isIntersecting || element.classList.contains('force')) {
          if (element.classList.contains('anim-img')) {
            const img = element.querySelector('img')
            if (img) {
              if (img.complete) {
                applyAnimation()
              } else {
                img.addEventListener('load', applyAnimation)
              }
            } else {
              applyAnimation()
            }
          } else {
            applyAnimation()
          }
        } else {
          if (once !== 'true') {
            element.classList.remove('anim-on')
          }
        }
      })
    }

    const options = {
      root: null,
      rootMargin: '0px',
      threshold: 0.4
    }

    const observer = new IntersectionObserver(triggerAnim, options)

    window.addEventListener('scroll', () => {
      lastScrollY = window.scrollY
    })

    animations.forEach(element => {
      observer.observe(element)
    })

    // Trigger animations for elements with .force class on page load
    container.querySelectorAll('.force').forEach(element => {
      const delay = element.dataset.delay || 0
      const speed = element.dataset.speed + 's' || '1s'

      const applyForceAnimation = () => {
        setTimeout(() => {
          element.style.animationDuration = speed
          element.classList.add('anim-on')
        }, delay)
      }

      if (element.classList.contains('anim-img')) {
        const img = element.querySelector('img')
        if (img) {
          if (img.complete) {
            applyForceAnimation()
          } else {
            img.addEventListener('load', applyForceAnimation)
          }
        } else {
          applyForceAnimation()
        }
      } else {
        applyForceAnimation()
      }
    })
  }
}

export default animations
