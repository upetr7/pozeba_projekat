'use strict'
// Ne moze ovako moras da izaberes iz svake tabelee pojedinacno
// Zbog enableButton
// document.querySlectorAll('table)[0].querySelectorAll(.delete-check)
// document.querySlectorAll('table)[1].querySelectorAll(.delete-check)
const deleteButtons = document.querySelectorAll('.delete-check')
for(let deleteButton of deleteButtons) {
    deleteButton.addEventListener('click', deleteCheck)
    deleteButton.addEventListener('click', enableButtonSadnice)
}
//
const btnSadnice = document.getElementById('btn-sadnice') 
const btnPozebe = document.getElementById('btn-pozebe') 
// uriArray.parentElement.parentElement.children[X].innerText
// X => polja koja identifikuju element
var uriArray = []
var uriString = '?'
var ixUriString = 0
//
function deleteCheck() {
    let classAttr = this.getAttribute('class')
    if(this.getAttribute('class').includes('delete-clicked')) {
        this.setAttribute('class', 'delete-check')
        let ix = uriArray.indexOf(this)
        uriArray = uriArray.slice(0, ix).concat(uriArray.slice(ix+1))
    } else {
        this.className += ' delete-clicked'
        // Da se ne bi duplirali 
        // Pa dupliraju se kad ih ne cistis
        if(!uriArray.includes(this))
            uriArray.push(this)

    }
}
function enableButtonSadnice() {
    if(uriArray.length) {
        btnSadnice.setAttribute('class', 'blue')
        btnSadnice.removeAttribute('disabled')
    } else {
        btnSadnice.setAttribute('disabled', 'disabled')
        btnSadnice.removeAttribute('class')
    }
}
function enableButtonPozebe() {
    if(uriArray.length) {
        btnPozebe.setAttribute('class', 'blue')
        btnPozebe.removeAttribute('disabled')
    } else {
        btnPozebe.setAttribute('disabled', 'disabled')
        btnPozebe.removeAttribute('class')
    }
}
function finnalDelete() {
    for(let deleteButton of uriArray) {
        let name = deleteButton.parentElement.parentElement.children[0].innerText
        let location = deleteButton.parentElement.parentElement.children[1].innerText
        // js func za encode decode uri
        // ako nema onda pozovi php da ti vrati sa njeogvom func
        // php ispisuje uz pomoc echoa!!
        if(ixUriString) uriString += '&'
        uriString += `name-${ixUriString}=${name}&location-${ixUriString}=${location}`
        ++ixUriString
    }
    console.log(uriString);
}



