/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 * 5/5/2020
 */

$(function () {
    $("#dialog,#MetaData,#Slides,#ServicesDialog,#ProjectsItems,#MediaDialog,#ClientsDialog").dialog({
        autoOpen: false,
        width: "auto",
        modal: true,
        height: ($(window).height() - 200),
        resizable: "auto"
    });
    $('.OpenDi').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#dialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.MetaUpdate').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#MetaData").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.show-slides-dialog').on("click", function () {
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#Slides").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.show-service-da').on("click", function (e) {
        e.preventDefault();
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#ServicesDialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.ShowAddMedia').on("click", function (e) {
        e.preventDefault();
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#MediaDialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.showAddProjects').on("click", function (e) {
        e.preventDefault();
        $.get('index.php?adminAction&Load=services', function (data) {
            $('select[name=service_list]').html(data);
            $.get('index.php?adminAction&Load=clients', function (cl) {
                $('select[name=client_id]').html(cl);
            });
        });
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#ProjectsItems").parent().css({position: "fixed"}).end().dialog('open');
    });
    $('.ClientShowAdd').on("click", function (e) {
        e.preventDefault();
        let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
        $activeDialogs.dialog('close');
        $("#ClientsDialog").parent().css({position: "fixed"}).end().dialog('open');
    });
    $("#tabs").tabs({
        beforeLoad: function (event, ui) {
            ui.jqXHR.fail(function () {
                ui.panel.html(
                    "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                    "If this wouldn't be a demo.");
            });
        }
    });
    $('form[name=actionForm]').on('submit', function (e) {
        e.preventDefault();
        let type = $(this).find('input[name=type]').val(), form = $(this);
        UpdateEditForm(form, type, {showSuccess: true});
    });
    $('select[name=projectType]').on('change', function () {
        let vl = $(this).val();
        $('.type-all').hide();
        $('.type-' + vl).show();
    });
    $('select[name=MediaType]').on('change', function () {
        let vl = $(this).val();
        if (vl === 'projects') {
            $('.media-button').show();
            $('select[name=media_id]').show();
            $.get('index.php?adminAction&Load=projects', function (data) {
                $('select[name=media_id]').html(data);
            });
        } else if (vl === 'slides') {
            $('.media-button').show();
            $('select[name=media_id]').hide();
        } else if (vl === 'items') {
            $('.media-button').show();
            $('select[name=media_id]').show();
            $.get('index.php?adminAction&Load=items', function (data) {
                $('select[name=media_id]').html(data);
            });
        } else if (vl === 'clients') {
            $('.media-button').show();
            $('select[name=media_id]').show();
            $.get('index.php?adminAction&Load=clients', function (data) {
                $('select[name=media_id]').html(data);
            });
        } else if (vl === "0") {
            $('select[name=media_id]').html('');
            $('.media-button').hide();
        }

    });
});

function Logout() {
    $.post('index.php?action&logout', function () {
        window.location.href = '?Control';
    });
}

function CreatSingleUpdateForm(item, type) {
    let updateDiv = $(item).parent().find('.updateReplace'), current_val = updateDiv.text();
    let TextBox = $('<input type="text" class="form-control" value="' + current_val + '" name="' + type + '">');
    updateDiv.replaceWith(TextBox);
}

let UpdateEditForm = function (form, type, options) {
    options = {
        showSuccess: false,
    };
    if (type === 'items' || type === 'media') {
        jQuery.ajax({
            url: 'index.php?adminAction&formAction=' + type,
            type: "POST",
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            success: function (result) {
                // if all is well
                // play the audio file
                alert(result);
                form[0].reset();
                let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
                $activeDialogs.dialog('close');
            }
        });
    } else {
        $.post('index.php?adminAction&formAction=' + type, form.serialize(), function (x) {
            alert(x);
            form[0].reset();
            let $activeDialogs = $(".ui-dialog:visible").find('.ui-dialog-content');
            $activeDialogs.dialog('close');
        });
    }

};
let CloneText = function (x) {
    let newData = $(x).parent().find('.clone-this').clone(),
        old = $(x).parent().find('.clone-this');
    old.removeClass('clone-this');
    $(newData).insertAfter(old);
};