'use strict'
const frmSadnice = document.forms[0]
const frmPozebe = document.forms[1]
const sadnice = document.querySelectorAll('.choose-frm li')[0]
const pozebe = document.querySelectorAll('.choose-frm li')[1]

// FUNC
function deleteField() {
    let parent = this.parentElement
    console.log(parent)
    parent.remove()
}

// SADNICE POZEBE ANIMATION
sadnice.addEventListener('click', () => {
    if(!sadnice.hasAttribute('class')) {
        sadnice.setAttribute('class', 'green')
        pozebe.removeAttribute('class')
    }
})
pozebe.addEventListener('click', ()=>{
    if(!pozebe.hasAttribute('class')) {
        pozebe.setAttribute('class', 'green')
        sadnice.removeAttribute('class')
    }

})