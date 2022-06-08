const targetEl = document.querySelectorAll('.dropdownMenu')
const triggerEl = document.querySelectorAll('.dropdownButton')

for (let index = 0; index < targetEl.length; index++) {
  const options = {
    placement: 'right'
  }

  const dropdown = new Dropdown(targetEl[index], triggerEl[index], options)
}
