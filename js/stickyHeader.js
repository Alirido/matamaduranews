window.onscroll = function () {fixedHeader()};

var header = document.getElementById("header-menu");
var unlist = document.getElementById("ulist");
var sticky = header.offsetTop;

function fixedHeader() {
    if (window.pageYOffset > sticky){
        header.classList.add("sticky__header");
        unlist.classList.add("mb-10");
    }else{
        header.classList.remove("sticky__header");
        unlist.classList.remove("mb-10");
    }
}
