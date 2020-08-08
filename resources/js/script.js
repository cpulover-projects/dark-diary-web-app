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
    // alert($(this).attr("id"));
})

$(document).on('click', '.list-group-item', function() {
    $(this).attr('style', function (i, s) {
        return (s || '') +
            'background-color: lightgrey !important;'
    });
});

//TODO: refactor
$(".list-group-item").mouseleave(function () {
    $(this).attr('style', function (i, s) {
        return (s || '') +
            'background-color: #F8F9FA !important;'
    });
})

$(document).on('click', '.list-group-item', function() {
    $(this).attr('style', function (i, s) {
        return (s || '') +
            'background-color: #F8F9FA !important;'
    });
});


$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

$(document).ajaxComplete(function() {
    $('[data-toggle="popover"]').popover();
  });

$('#content, #title, #date').bind('input propertychange', function () {
    $.ajax({
        method: "POST",
        url: "services/update-note.php",
        data: {
            title: $("#title").val(),
            date: $("#date").val(),
            content: $("#content").val()
        }
    }).done(function (msg) {
        ajaxLoadSidebarNote();
    }).fail(function () {
        console.error("Could not save note automatically");
    });    
});

$('#search').bind('input propertychange', function () {
    ajaxLoadSidebarNote();
});

function ajaxLoadSidebarNote(){
    $.ajax({
        method: "POST",
        url: "services/load-sidebar-note.php",
        data: {
            searchKeyword: $("#search").val()
        }    
    }).done(function(msg){
        // alert(msg);
        $(".list-group").html(msg);
    })
}

$('button.delete').click(function (){
    $(this).parent().css("display", "none")
    // alert($(this).parent().attr("id"));
    $.ajax({
        method: "POST",
        url: "services/delete-note.php",
        data: {
            noteId:  $(this).parent().attr("id")
        }
    })
})

$(document).on('click', 'button.delete', function() {
    $(this).parent().css("display", "none")
    // alert($(this).parent().attr("id"));
    $.ajax({
        method: "POST",
        url: "services/delete-note.php",
        data: {
            noteId:  $(this).parent().attr("id")
        }
    })
});

$('#addNote').click(function(){
    $.ajax({
        method: "POST",
        url: "services/add-new-note.php"
    }).done(function (){
        $("#title").val("");
        $("#date").val("");
        $("#content").val("");

        //ajaxLoadForm();
    })
})

function ajaxLoadForm(){
    $.ajax({
        method: "POST",
        url: "services/load-form.php"
    }).done(function (msg){
       $(".container-fluid").html(msg);
    })
}

