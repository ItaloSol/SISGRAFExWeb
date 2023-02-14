const MenusInternos = document.querySelectorAll('.menu-item');

var url = window.location.pathname;
const links = document.querySelectorAll('.menu-item a');
// console.log(url);
links.forEach(() => {
  var href = $(this).attr('href');
  if (url === href){
  //  console.log('works');
  }
 
});

function handleMenu(event) {
  //  event.preventDefault();
        MenusInternos.forEach((ativos) => {
            ativos.classList.remove('active');
        })
    event.currentTarget.classList.add('active');
    event.currentTarget.getAttribute('.menu-item');
}

MenusInternos.forEach((menu) => {
    menu.addEventListener('click', handleMenu);
})
