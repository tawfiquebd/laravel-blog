$(document).ready(function () {

    // Create or Update Contact page
    $('#contactCms').submit(function(event) {
        event.preventDefault();
        let form = $('#contactCms')[0];
        let formData = new FormData(form);
        $.ajax({
            url : baseUrl+'/createOrUpdateContact',
            type: 'POST',
            data : formData,
            contentType: false,
            processData: false,

            success: function(data) {
                refreshErrors();
                if(data.msg == 'created') {
                    $('#contact_section_name').val(data.contact.section_name);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Contact section created successfully.',
                    })
                }
                else {
                    $('#contact_section_name').val(data.contact.section_name);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Contact section updated successfully.',
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
        $('#contact_heading').removeClass('is-invalid');
        $('#contact_heading_help').text('');
        $('#contact_short_description').removeClass('is-invalid');
        $('#contact_short_description_help').text('');
        $('#contact_description').removeClass('is-invalid');
        $('#contact_description_help').text('');
    }



});
