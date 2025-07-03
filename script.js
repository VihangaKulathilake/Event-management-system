function scrollEvents(amount){
    const container=document.querySelector('.myRegEvents');
    container.scrollBy({
        left:amount,
        behavior:'smooth'
    });
}


document.addEventListener('DOMContentLoaded',()=>{
    const toggle=document.querySelector('.hmbicon');
    const nav=document.querySelector('.navleft');

    toggle.addEventListener('click',()=>{
        nav.classList.toggle('active');
    })
})