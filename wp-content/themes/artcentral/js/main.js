const label = document.getElementById('searchlabel');
const searchbar = document.getElementById('searchbar');
const button = document.getElementById('searchbutton');
const searchbarContainer = document.getElementById('searchbar-container');




function expand(){
      if(searchbar.style.display == 'none') {
        searchbar.style.display = 'block';
        button.style.display = 'block';
        label.style.display = 'none';
      }
    else {
      searchbar.style.display = 'none';
      button.style.display = 'none';
      label.style.display = 'block';
    }
  }

label.addEventListener('click', expand);

function changecolor(){
  menu = document.getElementById('menustylingsanker');
  if(scrollY>0){
    menu.style.background = 'linear-gradient(180deg, rgba(110,68,69,1) 50%, rgba(255,255,255,0) 100%)';
    menu.style.height = "100px";

  }
  else{
    menu.style.background = 'linear-gradient(180deg, rgba(110,68,69,1) 0%, rgba(110,68,69,1) 100%)';
    menu.style.height = "60px";
  }
}

window.addEventListener('scroll', changecolor);

function changebackground(){
  background = document.getElementsByTagName('section');
  if(scrollY>540){
    document.body.style.backgroundColor = '#FFFFFF';
  }
  else{
    document.body.style.backgroundColor = '#f5a021';
  }
}

window.addEventListener('scroll', changebackground);
