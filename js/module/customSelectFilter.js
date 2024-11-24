function customSelectFilter () {
  const customSelects = document.getElementsByClassName('custom-select')
  const filterItems = document.querySelectorAll('.filter-item')

  if (customSelects.length === 0) return

  Array.from(customSelects).forEach(customSelect => {
    const select = customSelect.getElementsByTagName('select')[0]
    const selectedDiv = createSelectedDiv(select)
    const optionsDiv = createOptionsDiv(select, selectedDiv)

    customSelect.appendChild(selectedDiv)
    customSelect.appendChild(optionsDiv)

    selectedDiv.addEventListener('click', toggleSelect)
  })

  function createSelectedDiv (select) {
    const div = document.createElement('DIV')
    div.className = 'select-selected'
    div.innerHTML = select.options[select.selectedIndex].innerHTML
    return div
  }

  function createOptionsDiv (select, selectedDiv) {
    const div = document.createElement('DIV')
    div.className = 'select-items select-hide'

    Array.from(select.options).forEach(option => {
      const optionDiv = document.createElement('DIV')
      optionDiv.innerHTML = option.innerHTML
      optionDiv.dataset.value = option.value
      optionDiv.addEventListener('click', () => updateSelectAndFilter(optionDiv, select, selectedDiv))
      div.appendChild(optionDiv)
    })

    return div
  }

  function toggleSelect (e) {
    e.stopPropagation()
    closeAllSelect(this)
    this.nextSibling.classList.toggle('select-hide')
    this.classList.toggle('select-arrow-active')
  }

  function updateSelectAndFilter (clickedOption, select, selectedDiv) {
    const value = clickedOption.dataset.value
    select.value = value
    selectedDiv.innerHTML = clickedOption.innerHTML

    clickedOption.parentNode.querySelector('.same-as-selected')?.classList.remove('same-as-selected')
    clickedOption.classList.add('same-as-selected')

    selectedDiv.click()
    filterEvents(value)
  }

  function filterEvents (filter) {
    if (!document.startViewTransition) {
      applyFilter(filter)
    } else {
      document.startViewTransition(() => applyFilter(filter))
    }
  }

  function applyFilter (filter) {
    filterItems.forEach(filterItem => {
      const dataTypes = filterItem.dataset.filter.split(',').map(type => type.trim())
      const match = filter === '*' || filter === 'abogado' || dataTypes.includes(filter)
      filterItem.style.display = match ? '' : 'none'
    })
  }

  function closeAllSelect (elmnt) {
    const selectItems = document.getElementsByClassName('select-items')
    const selectSelected = document.getElementsByClassName('select-selected')

    Array.from(selectSelected).forEach((item, index) => {
      if (elmnt !== item) {
        item.classList.remove('select-arrow-active')
        selectItems[index].classList.add('select-hide')
      }
    })
  }

  document.addEventListener('click', closeAllSelect)

  // Aplicar el filtro inicial
  const initialValue = customSelects[0].getElementsByTagName('select')[0].value
  filterEvents(initialValue)
}

export default customSelectFilter
