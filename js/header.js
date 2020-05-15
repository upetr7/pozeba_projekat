'use strict'
const nav = document.getElementsByClassName('nav')[0]
const ul2nd = nav.querySelectorAll('ul')[1]
const hoverLi = nav.querySelectorAll('ul')[0].querySelectorAll('li')[1]
hoverLi.addEventListener('mouseenter', () => {
    ul2nd.style.display = 'block'
    console.log('mouseenter!');
})
hoverLi.addEventListener('mouseleave', () => {
    ul2nd.style.display = 'none'
    console.log('mouseleave!');
})