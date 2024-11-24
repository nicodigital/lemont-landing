import barba from '@barba/core'
import barbaPrefetch from '@barba/prefetch'
import { removeOnce, animEnter, animLeave } from './gsap.js'
import functions from '../functions.js'
// import { getClickedItem, getClickedItemIndex, getClickedAnchor } from './clickedItem.js'

function transitions (deviceData) {
  barba.use(barbaPrefetch)

  barba.init({
    // cacheFirstPage: true,
    debug: true,
    sync: true,
    timeout: 10000, // default is 2000ms
    transitions: [
      // DEFAULT
      {
        once ({ next }) {
          console.log('ONCE DEFAULT')

          functions(next.container, deviceData)
          removeOnce() // Removemos la clase "once" para que saber que ya se ha cargado el ONCE
        },
        leave: ({ current }) => {
          console.log('LEAVE DEFAULT')
          // console.log(getClickedItem(), getClickedItemIndex(), getClickedAnchor())

          animLeave(current.container)

          return new Promise(resolve => {
            setTimeout(() => {
              resolve()
            }, 500)
          })
        },
        enter: ({ next }) => {
          console.log('ENTER DEFAULT')

          // animEnter(next.container)

          setTimeout(() => {
            functions(next.container, deviceData) // Tenemos que dare tiempo a la ejecución, debido a customRellax()
          }, 100)

          window.scrollTo(0, 0) // Force Scroll to top
        }
      }
    ]
  })
}

export default transitions
