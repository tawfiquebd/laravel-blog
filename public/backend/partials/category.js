$(document).ready(function () {
    $('#addCategory').submit(function(event) {
        event.preventDefault();
        // let categoryName = document.getElementById('category_name').value;
        let form = $('#addCategory')[0];
        let formData = new FormData(form);
        $.ajax({
            url : baseUrl+'/add-category',
            type: 'POST',
            data : formData,
            contentType: false,
            processData: false,

            success: function(data) {
                // document.getElementById('category_name').value = "";
                $('#addCategoryModal').modal('hide');
                onSuccessRemoveErrors();
                // sweet alert
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Category created successfully.',
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

    function onSuccessRemoveErrors() {
        $('#category_name').removeClass('is-invalid');
        $('#category_name').val('');
        $('#category_name_help').text('');
    }

    function refreshErrors() {
        $('#category_name').removeClass('is-invalid');
        $('#category_name_help').text('');
    }

    $('#addCategoryModal').on('hidden.bs.modal', function() {
        onSuccessRemoveErrors();
    })

});
