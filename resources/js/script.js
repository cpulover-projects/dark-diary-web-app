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
            'background-color: #F8F9FA !important;'
    });
})

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

$('input, textarea').bind('input propertychange', function () {
    $.ajax({
        method: "POST",
        url: "services/update-note.php",
        data: {
            title: $("#title").val(),
            date: $("#date").val(),
            content: $("#content").val()
        }
    }).done(function (msg) {
        alert("Save: "+msg);
    }).fail(function () {
        console.error("Could not save note automatically");
    });    
});