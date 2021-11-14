$(document).ready(function () {

    var table = $('#categories').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        order: [0, 'asc'],
        "ajax" : {
            'url' : baseUrl+'/getAllCategories',
            'type': 'GET',
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable:false},
            {data: 'action1', name: 'action1', orderable: false, searchable:false},
        ],

        "columnDefs" : [{
            "render": function (data, type, row, meta)
            {
                return `<a href="#" class="btn btn-primary btn-sm editCategory" id="${row.id}"> Edit </a> `
            },
            "targets" : 4
        },
        {
            "render": function (data, type, row, meta)
            {
                return `<a href="#" class="btn btn-danger btn-sm deleteCategory" id="${row.id}"> Delete </a> `
            },
            "targets" : 5
        },
        ]

    });


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
