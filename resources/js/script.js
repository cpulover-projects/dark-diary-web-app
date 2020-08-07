$(".toggleForms").click(function () {
    $("#signInForm").toggle();
    $("#signUpForm").toggle();
})


$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$(".list-group-item").hover(function () {
    $(this).attr('style', function (i, s) {
        return (s || '') +
            'background-color: lightgrey !important;'
    });
})

//TODO: refactor
$(".list-group-item").mouseleave(function () {
    $(this).attr('style', function (i, s) {
        return (s || '') +
            'background-color: white !important;'
    });
})

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });