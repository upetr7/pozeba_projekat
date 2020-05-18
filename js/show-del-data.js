'use strict'
// Ne moze ovako moras da izaberes iz svake tabelee pojedinacno
// Zbog enableButton
// document.querySlectorAll('table)[0].querySelectorAll(.delete-check)
// document.querySlectorAll('table)[1].querySelectorAll(.delete-check)
const btnSadnice = document.getElementById('btn-sadnice')
const btnPozebe = document.getElementById('btn-pozebe')
const deleteSadniceButtons = document.querySelectorAll('table')[0].querySelectorAll('.delete-check')
const deletePozebeButtons = document.querySelectorAll('table')[1].querySelectorAll('.delete-check')
var uriArraySadnice = []
var uriArrayPozebe = []
var uriString = '?'
var uriIxString = 0

for(let deleteButton of deleteSadniceButtons) {
    deleteButton.addEventListener('click', (clickedObject) => { deleteCheckSadnice(clickedObject.target) })
    deleteButton.addEventListener('click', () => { enableButton(btnSadnice, uriArraySadnice) })
}
for(let deleteButton of deletePozebeButtons) {
    deleteButton.addEventListener('click', (clickedObject) => { deleteCheckPozebe(clickedObject.target)})
    deleteButton.addEventListener('click', () => { enableButton(btnPozebe, uriArrayPozebe) })
}
btnSadnice.addEventListener('click', () => { finallDelete(uriArraySadnice) })
btnPozebe.addEventListener('click', () => { finallDelete(uriArrayPozebe) })
//
// uriArray.parentElement.parentElement.children[X].innerText
// X => polja koja identifikuju element
//
// Iz nekog razloga ne brise elemente iz niza kada posaljem preko funkcije ..
// Kako poslati po referenci predmet
function deleteCheckSadnice(btn) {
    if(btn.getAttribute('class').includes('delete-clicked')) {
        btn.setAttribute('class', 'delete-check')
        let ix = uriArraySadnice.indexOf(btn)
        btn.innerText = 'Избриши'
        uriArraySadnice = uriArraySadnice.slice(0, ix).concat(uriArraySadnice.slice(ix+1))

    } else {
        btn.className += ' delete-clicked'
        // Da se ne bi duplirali
        // Pa dupliraju se kad ih ne cistis
        if(!uriArraySadnice.includes(btn)) uriArraySadnice.push(btn)
        btn.innerText = 'Не бриши'
    }
}
function deleteCheckPozebe(btn) {
    if(btn.getAttribute('class').includes('delete-clicked')) {
        btn.setAttribute('class', 'delete-check')
        let ix = uriArrayPozebe.indexOf(btn)
        btn.innerText = 'Избриши'
        uriArrayPozebe = uriArrayPozebe.slice(0, ix).concat(uriArrayPozebe.slice(ix+1))

    } else {
        btn.className += ' delete-clicked'
        // Da se ne bi duplirali
        // Pa dupliraju se kad ih ne cistis
        if(!uriArrayPozebe.includes(btn)) uriArrayPozebe.push(btn)
        btn.innerText = 'Небриши'
    }
}
function enableButton(btn, uriArray) {
    if(uriArray.length) {
        btn.setAttribute('class', 'blue')
        btn.removeAttribute('disabled')
    } else {
        btn.setAttribute('disabled', 'disabled')
        btn.removeAttribute('class')
    }
}

function finallDelete(uriArray) {
    uriIxString = 0
    uriString = '?'
    for(let deleteButton of uriArray) {
        let name = deleteButton.parentElement.parentElement.children[0].innerText
        let location = deleteButton.parentElement.parentElement.children[1].innerText
        // js func za encode decode uri
        // ako nema onda pozovi php da ti vrati sa njeogvom func
        // php ispisuje uz pomoc echoa!!
        if(uriIxString) uriString += '&'
        if(uriArray === uriArraySadnice) 
            uriString += `name-${uriIxString}=${name}&location-${uriIxString}=${location}`
        if(uriArray === uriArrayPozebe)
            uriString += `key1-${uriIxString}=${name}&key2-${uriIxString}=${location}`
        ++uriIxString
    }
    console.log(uriString);
    let encodeUriString = encodeURI(uriString)
    window.location = `show-del-data.php${encodeUriString}`
}



