function hamburgerClick(){
    const elem = document.getElementById("hamburger-btn");
    const hamburger_menu_list = document.getElementById("hamburger-menu_list");
    
   if(hamburger_menu_list.classList.contains('active')){
        hamburger_menu_list.classList.remove('active');
        elem.classList.remove('close');
        elem.classList.add('open');
   } else {
        hamburger_menu_list.classList.add('active');
        elem.classList.remove('open');
        elem.classList.add('close');
   }
   // closeからopenにします
   // closeの時 -> opacity: 0, transform: (-100%, 0);
   // openの時 -> opacity: 1, transform: (0, 0); 
}