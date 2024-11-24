function tabs () {
  const tabs = document.querySelectorAll('.tabs')

  if (tabs.length > 0) {
    tabs.forEach(tab => {
      tab.addEventListener('click', (e) => {
        // console.log(e);
        const btnTab = e.target

        if (e.target && btnTab.classList.contains('tab-link')) {
          const tabLinks = tab.querySelectorAll('.tab-link')
          const tabContent = tab.querySelectorAll('.tab-content')
          // console.log(tabContent);

          const tabTarget = btnTab.dataset.tab

          tabLinks.forEach((btn) => {
            btn.classList.remove('active')
          })

          btnTab.classList.add('active')

          tabContent.forEach((content) => {
            const tabData = content.dataset.tab

            if (tabTarget != '*') {
              if (tabData === tabTarget) {
                content.classList.add('active')
              } else {
                content.classList.remove('active')
              }
            } else {
              content.classList.add('active')
            }
          })
        }
      })
    })
  }
}

export default tabs
