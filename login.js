function hamburgerClick(){
    const elem = document.getElementById("hamburger-btn");
    const hamburger_menu_list = document.getElementById("hamburger-menu_list");
    const main = document.getElementById("main");
    const body = document.getElementById("body");
    
   if(hamburger_menu_list.classList.contains('active')){
        hamburger_menu_list.classList.remove('active');
        main.classList.remove('active');
        body.classList.remove('active');
        elem.classList.remove('close');
        elem.classList.add('open');
   } else {
        hamburger_menu_list.classList.add('active');
        main.classList.add('active');
        body.classList.add('active');
        elem.classList.remove('open');
        elem.classList.add('close');
   }
   // closeからopenにします
   // closeの時 -> opacity: 0, transform: (-100%, 0);
   // openの時 -> opacity: 1, transform: (0, 0); 
   function reportWindowSize() {
     if(window.outerWidth >= 900){
          hamburger_menu_list.classList.remove('active');
          main.classList.remove('active');
          body.classList.remove('active');
          elem.classList.remove('close');
          elem.classList.add('open');
     }

   }
   window.onresize = reportWindowSize;
}