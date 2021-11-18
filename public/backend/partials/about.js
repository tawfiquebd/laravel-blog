$(document).ready(function () {

    // Create or Update About page
    $('#aboutCms').submit(function(event) {
        event.preventDefault();
        let form = $('#aboutCms')[0];
        let formData = new FormData(form);
        $.ajax({
            url : baseUrl+'/createOrUpdateAbout',
            type: 'POST',
            data : formData,
            contentType: false,
            processData: false,

            success: function(data) {
                refreshErrors();
                if(data.msg == 'created') {
                    $('#about_section_name').val(data.about.section_name);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'About section created successfully.',
                    })
                }
                else {
                    $('#about_section_name').val(data.about.section_name);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'About section updated successfully.',
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
        $('#about_heading').removeClass('is-invalid');
        $('#about_heading_help').text('');
        $('#about_short_description').removeClass('is-invalid');
        $('#about_short_description_help').text('');
        $('#about_description').removeClass('is-invalid');
        $('#about_description_help').text('');
    }



});
