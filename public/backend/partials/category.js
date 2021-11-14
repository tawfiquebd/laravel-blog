$(document).ready(function () {

    var table = $('#categories').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        pageLength: 10,
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
                return `<a href="#" class="btn btn-primary btn-sm editCategory" id="${row.id}"> <i class="fas fa-pencil-alt"></i> </a> `
            },
            "targets" : 4
        },
        {
            "render": function (data, type, row, meta)
            {
                return `<a href="#" class="btn btn-danger btn-sm deleteCategory" id="${row.id}">  <i class="far fa-trash-alt"></i>  </a> `
            },
            "targets" : 5
        },
        ]

    });

    // Create category
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
                table.ajax.reload();
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

    // Get category for edit
    $(document).on('click', '.editCategory', function(e) {
        e.preventDefault();
       let id = $(this).attr('id');
       $.ajax({
           url: baseUrl+'/getCategory/'+id,
           type: 'GET',
           processData: false,
           contentType: false,
           success: function(data) {
               $('#category_id').val(data.id);
               $('#edit_category').val(data.name);
               $('#editCategoryModal').modal('show');
           },
           error: function(data, textStatus, xhr) {
               // sweet alert
               Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'Sorry we were unable to find this record.',
               })
           },
       })

    });

    // Edit category
    $('#editCategory').submit(function(e) {
        e.preventDefault();
        let form = $('#editCategory')[0];
        let formData = new FormData(form);
        $.ajax({
            url: baseUrl+'/updateCategory',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                onSuccessRemoveEditErrors();
                $('#editCategoryModal').modal('hide');
                // sweet alert
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Category updated successfully.',
                })
                table.ajax.reload();
            },
            error: function(error) {
                if(error.status === 422) {
                    refreshEditErrors();
                    var errors = $.parseJSON(error.responseText);
                    $.each(errors.errors, function(key, value) {
                        $('#'+key).addClass('is-invalid');
                        $('#'+ key +'_help').text(value[0]);
                    })
                }
            }
        })
    })

    // Delete category
    $(document).on('click', '.deleteCategory', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');

        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    url: baseUrl+ '/deleteCategory/'+id,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // sweet alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Category deleted successfully.',
                        })
                        table.ajax.reload();
                    },
                    error: function(error) {
                        // sweet alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Sorry we were unable to find this record.',
                        })
                    }
                })

            }
        })





    })

    // On success remove error - edit category
    function onSuccessRemoveEditErrors() {
        $('#edit_category').removeClass('is-invalid');
        $('#edit_category').val('');
        $('#edit_category_help').text('');
    }

    function refreshEditErrors() {
        $('#edit_category').removeClass('is-invalid');
        $('#edit_category_help').text('');
    }

    $('#editCategoryModal').on('hidden.bs.modal', function() {
        onSuccessRemoveEditErrors();
    })

    // On success remove error - add category
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
