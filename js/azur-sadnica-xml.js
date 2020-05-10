'use strict'
const dels = document.querySelectorAll('.delete')
const btn_azur_sadnice = document.querySelector('button#btn-azur-sadnice')
var ix = 1 // zbog prvog zapisa
var last_child_sadnica = frmSadnice.querySelector('.fields-vl')

// inicijalizacija prvog zapisa
last_child_sadnica.addEventListener('input', btnEnableSadnica)
last_child_sadnica.addEventListener('click', createFieldSadnica)
last_child_sadnica.querySelector('.delete').addEventListener('click', deleteField)
for(let i = 0; i < last_child_sadnica.children.length - 1; i++)
    last_child_sadnica.children[i].addEventListener('input', checkAllSadnica)

// FUNC
// Ako su sva fields-vl tacna (imaju attr class=green) onda dozvoli slanje
function btnEnableSadnica() {
    // Ako postoji input sa red onemoguci slanje, ako su svi dobri salji
    let fields_vls = frmSadnice.querySelectorAll('.fields-vl')
    let brk = false
    for(let i = 0; i < fields_vls.length; i++) {
        if(brk) break
        for(let j = 0; j < 3; j++) {
            console.log(`i:${i} j:${j} ${fields_vls[i].children[j].getAttribute('class')}`);
            if(fields_vls[i].children[j].getAttribute('class') == 'red') {
                console.log('red');
                btn_azur_sadnice.setAttribute('disabled', 'disabled')
                brk = true
                break
            } else if(i == fields_vls.length - 1 && j == 2) {
                btn_azur_sadnice.removeAttribute('disabled')
            }

        }
    }
}
function createSadnicaElement() {
    let field = document.createElement('div')
    field.setAttribute('class', 'fields-vl')
    field.innerHTML = `<input type="text" name="name-${ix}">
                <input type="text" name="location-${ix}">
                <input type="text" name="temperature-${ix}">
                <input type="text" name="etc-${ix}">
                <div class="delete">X</div>`
    return field
}
// Sluzi da novo ubaceni element(fields-vl) postavi kao last
function replaceLastChildSadnica() {
    last_child_sadnica.removeEventListener('click', createFieldSadnica)
    last_child_sadnica.childNodes[0].removeEventListener('input', createFieldSadnica)
    last_child_sadnica = frmSadnice.lastChild
    last_child_sadnica.addEventListener('click', createFieldSadnica)
    last_child_sadnica.lastChild.addEventListener('click', deleteField)
    last_child_sadnica.childNodes[0].addEventListener('input', createFieldSadnica)
}
// Pravljenje novog fields-vl sa dodavanjem svih funkcionalnosti
function createFieldSadnica() {
    if (this.parentElement == frmSadnice || this.parentElement.parentElement == frmSadnice) {
        let sadnica_el = createSadnicaElement()
        for(let i = 0; i < sadnica_el.children.length - 1; i++)
            sadnica_el.children[i].addEventListener('input', checkAllSadnica)
        sadnica_el.addEventListener('input', btnEnableSadnica)
        frmSadnice.appendChild(sadnica_el)
        replaceLastChildSadnica()
        // sluzi za dodavenje delete diva
        if(ix != 1) 
            this.parentElement.lastChild.previousSibling.querySelector('.delete').style.visibility = 'visible'
        this.parentElement.lastChild.querySelector('.delete').style.visibility = 'hidden'
        ++ix;
    }
}

// PROVERA ISPRAVNOSTI
function checkFieldOne(el) {
    el = el.children[0]
    if(isNaN(el.value) && el.value.length > 0) {
        el.setAttribute('class', 'green')
        return 1 // Zamisao je da ovo iskoristis za bojenje bordera fields-vl kome pripada in
    }
    else {
        el.setAttribute('class', 'red')
        return 0
    }
}
function checkFieldTwo(el) {
    el = el.children[1]
    if(isNaN(el.value) && el.value.length > 0) {
        el.setAttribute('class', 'green')
        return 1
    }
    else {
        el.setAttribute('class', 'red')
        return 0
    }
}
function checkFieldThree(el) {
    el = el.children[2]
    if(!isNaN(el.value) && el.value.length > 0) {
        el.setAttribute('class', 'green')
        return 1
    }
    else {
        el.setAttribute('class', 'red')
        return 0
    }
}
// Ova func se poziva kad kod pritisne u bilo koji input u okviru fileds-vl
function checkAllSadnica() {
    checkFieldOne(this.parentElement)
    checkFieldTwo(this.parentElement)
    checkFieldThree(this.parentElement)

    // ZBOG NECEGA IZBACUJE CUDNJIKAVE GRESKICE
    // let greska = 0
    // if(!checkName(this.parentElement)) ++greska
    // if(!checkLocation(this.parentElement)) ++greska
    // if(!checkTemperature(this.parentElement)) ++greska
    // if(!greska) this.setAttribute('class', 'fields-vl green')
    // else this.setAttribute('class', 'fields-vl red')
}
