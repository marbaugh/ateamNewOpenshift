//Fix for anchor links with header offset
var shiftWindow = function() { scrollBy(0, -100) };
if (location.hash) shiftWindow();
window.addEventListener("hashchange", shiftWindow);

// Activates the Carousel
$('.carousel').carousel({
  interval: 5000
})

// Activates Tooltips for Social Links
$('.tooltip-social').tooltip({
  selector: "a[data-toggle=tooltip]"
})

//Fix for hiding bootstrap nav collapse on click
$('.nav a').on('click', function(){
    $(".btn-navbar").click(); //bootstrap 2.x
    $(".navbar-toggle").click() //bootstrap 3.x by Richard
});
