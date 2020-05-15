'use strict'

// Pribavljanje html objekata
// Prebaci na eng indentifikatore i u html
const povrsina = document.getElementById('povrsina')
const btnPosalji  = document.getElementById('posalji')

// Provera unosa
povrsina.addEventListener('input', () => {
    var povrs = document.getElementById('povrsina')

    if (povrs.value.length && !isNaN(povrs.value)) {
        povrs.style.borderColor = 'rgb(87, 255, 87)'
        btnPosalji.removeAttribute('disabled')
        btnPosalji.setAttribute('class','blue')
    } else {
        povrs.style.borderColor = 'rgb(243, 81, 81)'
        btnPosalji.setAttribute('disabled', 'disabled')
        btnPosalji.removeAttribute('class')
    }

})

// Azuriranje baze
const azur_xml = document.getElementById('xml')
azur_xml.addEventListener('click', () => {
    window.location = 'azur-xml.php'
})