'use strict'
const frmSadnice = document.forms[0]
const frmPozebe = document.forms[1]
const sadnice = document.querySelectorAll('.choose-frm li')[0]
const pozebe = document.querySelectorAll('.choose-frm li')[1]

// FUNC
function deleteField() {
    let parent = this.parentElement
    let frm = parent.parentElement
    console.log(frm);
    console.log(frm.children.length);
    parent.remove()
    // ako nakog svog brisanja ostane poslednji 
    // onda prikazi .delete    
    // 2 zbog fields-nm 
    if(frm.children.length == 2) 
        frm.children[1].querySelector('.delete').style.visibility = 'hidden'
    // ako ima vise od 1 onda prvom dodaj visibility
    if(frm.children.length > 2) 
        frm.children[1].querySelector('.delete').style.visibility = 'visible'
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