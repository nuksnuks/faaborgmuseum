label = document.getElementById('searchlabel');
const searchbar = document.getElementById('searchbar');
const button = document.getElementById('searchbutton');

function expand(){
  searchbar.style.display = block;
  button.style.display = block;
}

label.addEventListener('click', expand);
