import { gsap } from "gsap";

export function removeOnce( container ) {
  setTimeout(() => { // Removemos la clase "once" para que saber que ya se ha cargado el ONCE
    document.querySelector('body').classList.remove('once');
  },3000)
}

export function animEnter( container ) {
  container.classList.remove('once');
  return gsap.from(container, { autoAlpha: 0, duration: 1, y: 20, clearProps: "all" } );
}

export function animLeave( container ) {
  return gsap.to( container, { autoAlpha: 0, duration: 0.5, y: -20 } );
}
