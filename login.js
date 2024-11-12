function hamburgerClick(){
    const elem = document.getElementById("hamburger-btn");
    const hamburger_menu_list = document.getElementById("hamburger-menu_list");
    
   if(elem.classList.toggle('close')){
       //    hamburger_menu_list.style.transform = '(0, 0)';
        hamburger_menu_list.style.transform = 'translateX(0)';
        hamburger_menu_list.style.opacity = '1';
        elem.classList.toggle('open');
   } else {
       // hamburger_menu_list.style.transform = '(-100%, 0)';
        hamburger_menu_list.style.transform = 'translateX(-100%)';
        hamburger_menu_list.style.opacity = '0';
        elem.classList.toggle('open');
   }
   // closeからopenにします
   // closeの時 -> opacity: 0, transform: (-100%, 0);
   // openの時 -> opacity: 1, transform: (0, 0); 
}