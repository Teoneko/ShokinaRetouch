const imgs = document.querySelectorAll('img')
function elementInViewport(el) {
    var bounds = el.getBoundingClientRect();
    return (
        (bounds.top + bounds.height > 0) && // Елемент ниже верхней границы
        (window.innerHeight - bounds.top > 0) && // Выше нижней
        (bounds.left + bounds.width > 0) && // Правее левой
        (window.innerWidth - bounds.left > 0)// Левее правой
    );
}


const aaaaaaaa = () => {
    imgs.forEach((img) => {
        let inViewport = elementInViewport(img);
        if (inViewport) {
            // setTimeout((()=>{
            img.classList.add('inView')
            // }
            // ), 1000)

        } else {
            img.classList.remove('inView')
        }
    })
}

document.addEventListener("scroll", aaaaaaaa);
document.addEventListener('DOMContentLoaded', aaaaaaaa);