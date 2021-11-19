$(document).ready(function(){

    $('#contactForm').submit(function(event) {
        event.preventDefault();
        let form = $('#contactForm')[0];
        let formData = new FormData(form);
        $.ajax({
            url : baseUrl+'/createContactMessage',
            type: 'POST',
            data : formData,
            contentType: false,
            processData: false,

            success: function(data) {
                onSuccessRemoveErrors();
                // sweet alert
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Thanks for contacting us. We will respond to your query asap.',
                })
            },
            error: function(error) {
                if(error.status === 422) {
                    refreshErrors();
                    var errors = $.parseJSON(error.responseText);
                    $.each(errors.errors, function(key, value) {
                        $('#'+key).addClass('is-invalid');
                        $('#'+ key +'_help').text(value[0]);
                    })
                }
            }
        });
    });



    // On success remove error - add category
    function onSuccessRemoveErrors() {
        $('#name').removeClass('is-invalid');
        $('#name').val('');
        $('#name_help').text('');

        $('#email').removeClass('is-invalid');
        $('#email').val('');
        $('#email_help').text('');

        $('#message').removeClass('is-invalid');
        $('#message').val('');
        $('#message_help').text('');
    }

    function refreshErrors() {
        $('#name').removeClass('is-invalid');
        $('#name_help').text('');
        $('#email').removeClass('is-invalid');
        $('#email_help').text('');
        $('#message').removeClass('is-invalid');
        $('#message_help').text('');
    }


})
