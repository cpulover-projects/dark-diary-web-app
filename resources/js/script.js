$(".toggleForms").click(function () {
    $("#signInForm").toggle();
    $("#signUpForm").toggle();
});
$(document).ready(function () {
    $('#submit1').prop('disabled', true);
    $('#submit2').prop('disabled', true);

});
$('#email1, #password1, #passwordConfirm, #email2, #password2').bind('input propertychange', function () {
    if ($('#email1').val() && $('#password1').val() && $('#passwordConfirm').val()) {
        $('#submit1').prop('disabled', false);
    } else {
        $('#submit1').prop('disabled', true);
    }
    if ($('#email2').val() && $('#password2').val()) {
        $('#submit2').prop('disabled', false);
    } else {
        $('#submit2').prop('disabled', true);
    }
});
$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
$(document).on('mouseover', '.list-group-item', function () {
    $(this).attr('style', function (i, s) {
        return (s || '') +
            'background-color: lightgrey !important;'
    });
});
// //TODO: refactor
$(document).on('mouseleave', '.list-group-item', function () {
    if (!$(this).hasClass("selected")) {
        $(this).attr('style', function (i, s) {
            return (s || '') +
                'background-color: #F8F9FA !important;'
        });
    }
});
$(document).on('click', '.list-group-item', function (e) {
    $("[data-toggle='popover']").popover('hide');
    $('.list-group-item').not(this).removeClass("selected");
    $('.list-group-item').not(this).attr('style', function (i, s) {
        return (s || '') +
            'background-color: #F8F9FA !important;'
    });
    $(this).addClass("selected");

    var noteTitle = $(this).find('#fullTitle').html();
    var noteDate = $(this).find('#fullDate').html();
    var noteContent = $(this).find('#fullContent').html();
    //remove listener temporary to prevent updating note when selecting
    CKEDITOR.instances.content.removeListener( 'change', handleChangeContent);
    $.ajax({
        method: "POST",
        url: "services/update-note.php",
        data: {
            selectedNoteId: $(this).attr("id"),
        }
    }).done(function (msg) {
        $("#title").val(noteTitle);
        $("#date").val(noteDate);
        CKEDITOR.instances.content.setData(noteContent);
        countWord(CKEDITOR.instances.content.getData());
        //add listener again
        CKEDITOR.instances.content.on('change', handleChangeContent);
    });
});

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

$(document).ajaxComplete(function () {
    $('[data-toggle="popover"]').popover();
});

$('#title, #date').bind('input propertychange', function () {
    // console.log("title or date changed..")
    updateNote();
});

CKEDITOR.instances.content.on('change', handleChangeContent);

function handleChangeContent(){
    var contentField = CKEDITOR.instances.content.getData();
    if (contentField == "" && $('#title').val() == "" && $('#date').val() == "") {
        //when delete current note, no update
    } else {
        // console.log(">>> Updating note...");
        updateNote();
    }
    countWord(contentField);
}

/**
 * Returns the text from a HTML string
 * 
 * @param {html} String The html string
 */
function stripHtml(html) {
    // Create a new div element
    var temporalDivElement = document.createElement("div");
    // Set the HTML content with the providen
    temporalDivElement.innerHTML = html;
    // Retrieve the text property of the element (cross-browser support)
    return temporalDivElement.textContent || temporalDivElement.innerText || "";
}

function countWord(field) {
    var str = stripHtml(field);
    var fieldLength = str.split(' ')
        .filter(function (n) {
            return n != ''
        })
        .length;
    $('#wordCount').val(fieldLength + " word(s)");
    // $('#wordCount').val(str);
}

function updateNote() {
    if ($("#date").val()) {
        var theDate = $("#date").val();
    } else {
        var theDate = getCurrentDate();
    }
    // console.log(CKEDITOR.instances.content.getData());

    $.ajax({
        method: "POST",
        url: "services/update-note.php",
        data: {
            title: $("#title").val(),
            date: theDate, //$("#date").val(),
            content: CKEDITOR.instances.content.getData(),
        }
    }).done(function (msg) {
        if (msg) { //if editing an existing note, just override its sidebar content
            $("#" + msg).find("b").text(summarize('title', $("#title").val()));
            $("#" + msg).attr("data-original-title", $("#title").val());
            $("#" + msg).attr("data-content", summarize('content', stripHtml(CKEDITOR.instances.content.getData())));

            $("#" + msg).find("#fulltitle").text($("#title").val());
            $("#" + msg).find("#fullContent").html(CKEDITOR.instances.content.getData());
            $("#" + msg).find("#fullDate").text(theDate);

            console.log(msg);
        } else { //else reload sidebar to add new note
            ajaxLoadSidebarNote();
        }

        
    }).fail(function () {
        console.error("Could not save note automatically");
    });

    $("[data-toggle='popover']").popover('hide');
}

function summarize(type, str) {
    var maxSize;
    if (type == 'title') {
        maxSize = 18;
    } else {
        maxSize = 400;
    }

    if (str.length < maxSize) {
        return str;
    } else {
        return str.substring(0, maxSize) + "...";
    }
}

function getCurrentDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    return today = yyyy + '/' + mm + '/' + dd;
};

$('#search').bind('input propertychange', function () {
    ajaxLoadSidebarNote();
});

function ajaxLoadSidebarNote() {
    $.ajax({
        method: "POST",
        url: "services/load-sidebar-note.php",
        data: {
            searchKeyword: $("#search").val()
        }
    }).done(function (msg) {
        // alert(msg);
        $(".list-group").html(msg);
    })
};

$(document).on('click', 'button.delete', function (e) {
    e.stopPropagation();

    $(this).parent().parent().parent().parent().css("display", "none");
    // alert($(this).parent().attr("id"));
    $.ajax({
        method: "POST",
        url: "services/delete-note.php",
        data: {
            noteId: $(this).parent().parent().parent().parent().attr("id")
        }
    }).done(function (msg) {
        //if the deleted note is the current note => reset form
        if (msg) {
            $("#title").val("");
            $("#date").val("");
            CKEDITOR.instances.content.setData("");
            // $("#countWord").val("");
        }
    })
});

$('#addNote').click(function () {
    $.ajax({
        method: "POST",
        url: "services/add-new-note.php"
    }).done(function () {
        $("#title").val("");
        $("#date").val("");
        CKEDITOR.instances.content.setData("");
    })
});

$('.star').click(function () {

});