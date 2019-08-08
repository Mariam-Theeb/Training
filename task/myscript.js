var search = document.getElementById("search-icon");
search.addEventListener("click", openSearch);
var close = document.getElementById("close-search");
close.addEventListener("click", closeSearch);
var menu = document.getElementById("dropdown-menu");
menu.addEventListener("click", dropDown);
//Opens search bar
function openSearch() {
    document.getElementById("search-menu").style.display = "block";
    document.body.style['overflow-y'] = 'hidden';
}
//Close search bar
function closeSearch() {
    document.getElementById("search-menu").style.display = "none";
    document.body.style['overflow-y'] = 'visible';
}
//Opens dropdown menu for regions
function dropDown() {
    document.getElementById("arrow").classList.toggle("fa-angle-up");
    document.getElementById("my-dropdown").classList.toggle("show");
}
