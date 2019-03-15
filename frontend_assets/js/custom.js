$(document).ready(function() {
    if ($(".line-fixed-position").length > 0) {}
});


$(document).ready(function() {
    $("#testimonial-slider").owlCarousel({
        loop: true,
        items: 2,
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2],
        itemsMobile: [600, 1],
        pagination: true,
        navigation: false,
        navigationText: ["", ""],
        slideSpeed: 1000,
        autoPlay: true,

    });

});

$(document).ready(function() {
    $(".dropbtn").click(function() {
        $("#myDropdown").slideToggle('slow');

    });
})



// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}