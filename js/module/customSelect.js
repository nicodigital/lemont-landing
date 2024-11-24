// Uso:
// const customSelect = new CustomSelect('.select')
function customSelect () {
  class CustomSelect {
    constructor (selector) {
      this.selects = document.querySelectorAll(selector)
      this.init()
    }

    init () {
      this.selects.forEach(wrapper => {
        const select = wrapper.querySelector('select')
        if (!select) return

        const customSelect = this.createCustomSelect(select)
        const optionList = this.createOptionList(select)

        wrapper.appendChild(customSelect)
        wrapper.appendChild(optionList)

        this.setupEventListeners(customSelect, optionList, select)
      })

      document.addEventListener('click', this.closeAllSelect.bind(this))
    }

    createCustomSelect (select) {
      const div = document.createElement('div')
      div.className = 'select-selected'
      div.textContent = select.options[select.selectedIndex].textContent
      return div
    }

    createOptionList (select) {
      const container = document.createElement('div')
      container.className = 'select-items select-hide'

      Array.from(select.options).slice(1).forEach(option => {
        const item = document.createElement('div')
        item.textContent = option.textContent
        item.addEventListener('click', (e) => this.handleOptionClick(e, select))
        container.appendChild(item)
      })

      return container
    }

    handleOptionClick (e, select) {
      const clickedOption = e.target
      const selectedDisplay = clickedOption.parentNode.previousSibling

      Array.from(select.options).forEach((option, index) => {
        if (option.textContent === clickedOption.textContent) {
          select.selectedIndex = index
          selectedDisplay.textContent = clickedOption.textContent

          this.removeSelectedClass(clickedOption.parentNode)
          clickedOption.classList.add('same-as-selected')
        }
      })

      // Trigger change event
      select.dispatchEvent(new Event('change'))
      selectedDisplay.click()
    }

    removeSelectedClass (parent) {
      const selected = parent.getElementsByClassName('same-as-selected')
      Array.from(selected).forEach(el => el.classList.remove('same-as-selected'))
    }

    setupEventListeners (customSelect, optionList, select) {
      customSelect.addEventListener('click', (e) => {
        e.stopPropagation()
        this.closeAllSelect(customSelect)
        optionList.classList.toggle('select-hide')
        customSelect.classList.toggle('select-arrow-active')
      })
    }

    closeAllSelect (exceptElement) {
      const items = document.getElementsByClassName('select-items')
      const selected = document.getElementsByClassName('select-selected')

      Array.from(selected).forEach((el, index) => {
        if (el !== exceptElement) {
          el.classList.remove('select-arrow-active')
          items[index]?.classList.add('select-hide')
        }
      })
    }
  }

  const customSelect = new CustomSelect('.select')
}
export default customSelect
