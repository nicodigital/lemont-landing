function cookies () {
  function setCookie (cname, cvalue, exdays) {
    const d = new Date()
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000))
    const expires = 'expires=' + d.toUTCString()
    document.cookie = cname + '=' + cvalue + '; ' + expires + '; path=/'
  }

  function checkCookie (user) {
    const cookieArr = document.cookie.split(';')
    for (let i = 0; i < cookieArr.length; i++) {
      const cookiePair = cookieArr[i].split('=')
      if (user == cookiePair[0].trim()) {
        return decodeURIComponent(cookiePair[1])
      }
    }
    return null
  }

  function removeCookie (tabs, cook) {
    const removing = browser.cookies.remove({
      url: tabs[0].url,
      name: cook
    })

    removing.then(onRemoved, onError)
  }

  return {
    setCookie,
    checkCookie,
    removeCookie
  }
}

export default cookies()
