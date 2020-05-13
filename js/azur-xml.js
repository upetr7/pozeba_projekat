'use strict'
const frmSadnice = document.forms[0]
const frmPozebe = document.forms[1]
const btnAzurSadnice = document.querySelector('#btn-azur-sadnice')
const btnAzurPozebe = document.querySelector('#btn-azur-pozebe')
const chooseFrmSadnice = document.querySelectorAll('.choose-frm li')[0]
const chooseFrmPozebe = document.querySelectorAll('.choose-frm li')[1]
var ixSadnice = 0, ixPozebe = 0;

// SADNICE POZEBE ANIMATION
chooseFrmSadnice.addEventListener('click', () => {
    if(!chooseFrmSadnice.hasAttribute('class')) {
        chooseFrmSadnice.setAttribute('class', 'green')
        chooseFrmPozebe.removeAttribute('class')
        frmSadnice.style.display = 'block'
        frmPozebe.style.display = 'none'
        btnAzurSadnice.style.display = 'block'
        btnAzurPozebe.style.display = 'none'
        btnAzurSadnice.style.margin = '30px auto'
    }
})
chooseFrmPozebe.addEventListener('click', ()=>{
    if(!chooseFrmPozebe.hasAttribute('class')) {
        chooseFrmPozebe.setAttribute('class', 'green')
        chooseFrmSadnice.removeAttribute('class')
        frmSadnice.style.display = 'none'
        frmPozebe.style.display = 'block'
        btnAzurSadnice.style.display = 'none'
        btnAzurPozebe.style.display = 'block'
        btnAzurPozebe.style.margin = '30px auto'
    }
})

// = Delete =
function deleteField() {
    let parent = this.parentElement
    parent.remove()
}
//
function checkAll(input) {
    // Mora da bude da svi budu green, jer postoji mogucnost da budu plavi
    // Ova jedicina zbog .delete
    let field = input.parentElement
    field.style.border = '1px solid transparent' // stavi u css
    for(let i = 0; i < field.children.length - 1; i++) 
        if(field.children[i].style.borderColor != 'green') {
            field.style.borderColor = 'red'
            break
        } else if(i == field.children.length - 2)
            field.style.borderColor = 'green'
}
function checkTextualInput() {
    if(isNaN(this.value) && this.value.length > 0)
        this.style.borderColor = 'green'
    else
        this.style.borderColor = 'red'
    checkAll(this)
}
function checkNumericInput() {
    if(!isNaN(this.value) && this.value.length > 0)
        this.style.borderColor = 'green'
    else
        this.style.borderColor = 'red'
    checkAll(this)
}
// Mozda ce postojati
// = Button =
function enableButtonSadnica() {
    let fields = frmSadnice.querySelectorAll('.fields-vl')
    for(let i = 0; i < fields.length; i++) {
        console.log(fields[i].style.borderColor);
        if(fields[i].style.borderColor == 'red') {
            console.log('set diabled');
            btnAzurSadnice.setAttribute('disabled', 'disabled')
            btnAzurSadnice.removeAttribute('class')
            break
        } else if(i == fields.length - 1) {
            console.log('rm disabled');
            btnAzurSadnice.removeAttribute('disabled')
            btnAzurSadnice.setAttribute('class', 'blue')
        }
    }
}
function enableButtonPozebe() {
    let fields = frmPozebe.querySelectorAll('.fields-vl')
    for(let i = 0; i < fields.length; i++) {
        console.log(fields[i].style.borderColor);
        if(fields[i].style.borderColor == 'red') {
            console.log('set diabled');
            btnAzurPozebe.setAttribute('disabled', 'disabled')
            btnAzurPozebe.removeAttribute('class')
            break
        } else if(i == fields.length - 1) {
            console.log('rm disabled');
            btnAzurPozebe.removeAttribute('disabled')
            btnAzurPozebe.setAttribute('class', 'blue')
        }
    }
}
// Creating Element
function createFieldHtml(form) {
    let fieldHtml;
    if(form == frmSadnice) {
        fieldHtml = document.createElement('div')
        fieldHtml.setAttribute('class', 'fields-vl')
        fieldHtml.innerHTML = `<input type="text" name="name-${ixSadnice}">
            <input type="text" name="location-${ixSadnice}">
            <input type="number" name="temperature-${ixSadnice}">
            <input type="text" name="etc-${ixSadnice}">
            <div class="delete">X</div>`;
        ++ixSadnice
        return fieldHtml
    } 
    fieldHtml = document.createElement('div')
    fieldHtml.setAttribute('class', 'fields-vl')
    fieldHtml.innerHTML = `<input type="text" name="name-${ixPozebe}">
        <input type="text" name="pozebe-${ixPozebe}">
        <input type="text" name="pozebee-${ixPozebe}">
        <input type="text" name="etc-${ixPozebe}">
        <div class="delete">X</div>`;
    ++ixPozebe
    return fieldHtml
}

function createFieldSadnice() {
    let field = createFieldHtml(frmSadnice)
    frmSadnice.appendChild(field)
    let fieldInputs = field.querySelectorAll('input')
    // = Event za stvaranje novog fielda =
    for(let i = 0; i < fieldInputs.length; i++) 
        fieldInputs[i].addEventListener('input', createFieldSadnice)
    // Ako postoji vise od 1 fielda onda prethodnom iskljuci event za stvaranje novog fielda
    if(frmSadnice.children.length > 2) {
        let prevFieldInputs = field.previousSibling.querySelectorAll('input')
        for(let i = 0; i < prevFieldInputs.length; i++) 
            prevFieldInputs[i].removeEventListener('input', createFieldSadnice)
    }
    // = Delete = !! Prvo Delete pa Provera !! da bi radilo kako treba
    field.lastChild.addEventListener('click', deleteField)
    field.lastChild.style.visibility = 'hidden' // Novo stvorenom(poslednjem) iskljuci vid
    if(frmSadnice.children.length > 2) // Ako ima vise od 1 fielda onda prethodnom ukljuci
    field.previousSibling.lastChild.style.visibility = 'visible'
    //  = Provera =
    // Za tacnost i button
    for(let i = 0; i < fieldInputs.length; i++) {
        if(fieldInputs[i].getAttribute('type') == 'text')
            fieldInputs[i].addEventListener('input', checkTextualInput)
        else if(fieldInputs[i].getAttribute('type') == 'number')
            fieldInputs[i].addEventListener('input', checkNumericInput)
        // enableButtonSadnica na poslednjem mestu
        fieldInputs[i].addEventListener('input', enableButtonSadnica)
        // else some spec
    }
}
function createFieldPozebe() {
    let field = createFieldHtml(frmPozebe)
    frmPozebe.appendChild(field)
    let fieldInputs = field.querySelectorAll('input')
    // = Event za stvaranje novog fielda =
    for(let i = 0; i < fieldInputs.length; i++) 
        fieldInputs[i].addEventListener('input', createFieldPozebe)
    // Ako postoji vise od 1 fielda onda prethodnom iskljuci event za stvaranje novog fielda
    if(frmPozebe.children.length > 2) {
        let prevFieldInputs = field.previousSibling.querySelectorAll('input')
        for(let i = 0; i < prevFieldInputs.length; i++) 
            prevFieldInputs[i].removeEventListener('input', createFieldPozebe)
    }
    // = Delete = !! Prvo Delete pa Provera !! da bi radilo kako treba
    field.lastChild.addEventListener('click', deleteField)
    field.lastChild.style.visibility = 'hidden' // Novo stvorenom(poslednjem) iskljuci vid
    if(frmPozebe.children.length > 2) // Ako ima vise od 1 fielda onda prethodnom ukljuci
    field.previousSibling.lastChild.style.visibility = 'visible'
    //  = Provera =
    // Za tacnost i button
    for(let i = 0; i < fieldInputs.length; i++) {
        if(fieldInputs[i].getAttribute('type') == 'text')
            fieldInputs[i].addEventListener('input', checkTextualInput)
        else if(fieldInputs[i].getAttribute('type') == 'number')
            fieldInputs[i].addEventListener('input', checkNumericInput)
        // enableButtonSadnica na poslednjem mestu
        fieldInputs[i].addEventListener('input', enableButtonPozebe)
        // else some spec
    }
}

createFieldSadnice()
createFieldPozebe()