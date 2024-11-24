export default function darkModeOS ({ setCookie }) {
  if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    setCookie('darkmodeOS', 'on', 30)
  }
}
