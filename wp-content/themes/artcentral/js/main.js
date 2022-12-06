label = document.getElementById('searchlabel');
const searchbar = document.getElementById('searchbar');
const button = document.getElementById('searchbutton');

function expand(){
      if(searchbar.style.display == 'none'){
      searchbar.style.display = 'block';
      button.style.display = 'block';
    }
    else{
      searchbar.style.display = 'none';
      button.style.display = 'none';
    }
  };

label.addEventListener('click', expand);

function changecolor(){
  menu = document.getElementById('menustylingsanker')
if(scrollY>0){
  menu.style.background = '';
  menu.style.background = 'linear-gradient(180deg, rgba(110,68,69,1) 0%, rgba(255,255,255,0) 100%)';
}
else{
menu.style.background = '';
}

};

window.addEventListener('scroll', changecolor);
