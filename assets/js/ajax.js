$( document ).ready(function() {
    $("#btn").click(
        function(){
            sendAjaxForm('result_form', 'ajax_form', '/components/save_comment.php');

            return false;
        }
    );
});

function sendAjaxForm(result_form, ajax_form, url) {
    var formData = new FormData();

    formData.append('photo', $('input[type=file]')[0].files[0]);
    formData.append('name', $("input[name='name']").val());
    formData.append('email', $("input[name='email']").val());
    formData.append('message', $("textarea[name='message']").val());
    $.ajax({
        url:     url,
        type:     "POST",
        dataType: "html",
        contentType: false,
        processData: false,
        data: formData,
        success: function(response) {
            $('#result_form').html(response);
        },
        error: function(response) {
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}

$( document ).ready(function() {
    $("#date_ad").change(
        function(){
            sortForm('sort_form_reg', '/components/sort_comment_admin.php');
            return false;
        }
    );
    $("#email_ad").change(
        function(){
            sortForm('sort_form_reg', '/components/sort_comment_admin.php');
            return false;
        }
    );
    $("#name_ad").change(
        function(){
            sortForm('sort_form_reg', '/components/sort_comment_admin.php');

            return false;
        }
    );
});

$( document ).ready(function() {
    $("#date").change(
        function(){
           sortForm('sort_form', '/components/sort_comment.php');
            return false;
        }
    );
    $("#email").change(
        function(){
            sortForm('sort_form', '/components/sort_comment.php');
             return false;
        }
    );
    $("#name").change(
        function(){
            sortForm('sort_form', '/components/sort_comment.php');

             return false;
        }
    );
});

function sortForm(sort_form, url) {

    $.ajax({
        url:     url,
        type:     "POST",
        dataType: "html",
        data: $("#"+sort_form).serialize(),
        success: function(response) {
            $('#result_sort').html(response);
        },
        error: function(response) {
        }
    });
}
