$(document).ready(function () {

    // Create or Update Contact page
    $('#footerSection').submit(function(event) {
        event.preventDefault();
        let form = $('#footerSection')[0];
        let formData = new FormData(form);
        $.ajax({
            url : baseUrl+'/createOrUpdateFooter',
            type: 'POST',
            data : formData,
            contentType: false,
            processData: false,

            success: function(data) {
                refreshErrors();
                if(data.msg == 'created') {
                    $('#footer_section_name').val(data.footer.section_name);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Footer section created successfully.',
                    })
                }
                else {
                    $('#footer_section_name').val(data.footer.section_name);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Footer section updated successfully.',
                    })
                }

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



    function refreshErrors() {
        $('#twitter').removeClass('is-invalid');
        $('#twitter_help').text('');
        $('#facebook').removeClass('is-invalid');
        $('#facebook_help').text('');
        $('#instagram').removeClass('is-invalid');
        $('#instagram_help').text('');
    }



});
