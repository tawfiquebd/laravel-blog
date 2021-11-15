$(document).ready(function () {

    var table = $('#blogs').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        pageLength: 10,
        order: [0, 'desc'],
        "ajax" : {
            'url' : baseUrl+'/getAllBlogs',
            // if data table has more than 5 columns then use type: POST method and pass data: token
            'type': 'POST',
            'data': {
                '_token' : $("meta[name='csrf-token']").attr('content')
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'user_id', name: 'user_id'},
            {data: 'category_id', name: 'category_id'},
            {data: 'title', name: 'title'},
            {data: 'short_description', name: 'short_description'},
            {data: 'active', name: 'active'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable:false},
            {data: 'action1', name: 'action1', orderable: false, searchable:false},
        ],

        "columnDefs" : [
            {
                "render": function (data, type, row, meta)
                {
                    return `<img src="${baseUrl}/images/blogImages/${row.image}" class="img-thumbnail rounded" />`;
                },
                "targets" : 1
            },
            {
                "render": function (data, type, row, meta)
                {
                    return `<a href="${baseUrl}/editBlog/${row.id}" class="btn btn-primary btn-sm "> <i class="fas fa-pencil-alt"></i> </a> `
                },
                "targets" :8
            },
            {
                "render": function (data, type, row, meta)
                {
                    return `<a href="#" class="btn btn-danger btn-sm deleteTag" id="${row.id}">  <i class="far fa-trash-alt"></i>  </a> `
                },
                "targets" : 9
            },
        ]

    });

    // Create Tag
    // $('#addTag').submit(function(event) {
    //     event.preventDefault();
    //     let form = $('#addTag')[0];
    //     let formData = new FormData(form);
    //     $.ajax({
    //         url : baseUrl+'/addTag',
    //         type: 'POST',
    //         data : formData,
    //         contentType: false,
    //         processData: false,
    //
    //         success: function(data) {
    //             $('#addTagModal').modal('hide');
    //             onSuccessRemoveErrors();
    //             // sweet alert
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Success',
    //                 text: 'Tag created successfully.',
    //             })
    //             table.ajax.reload();
    //         },
    //         error: function(error) {
    //             if(error.status === 422) {
    //                 refreshErrors();
    //                 var errors = $.parseJSON(error.responseText);
    //                 $.each(errors.errors, function(key, value) {
    //                     $('#'+key).addClass('is-invalid');
    //                     $('#'+ key +'_help').text(value[0]);
    //                 })
    //             }
    //         }
    //     });
    // });
    //
    // // Get Tag for edit
    // $(document).on('click', '.editTag', function(e) {
    //     e.preventDefault();
    //     let id = $(this).attr('id');
    //     $.ajax({
    //         url: baseUrl+'/getTag/'+id,
    //         type: 'GET',
    //         processData: false,
    //         contentType: false,
    //         success: function(data) {
    //             $('#tag_id').val(data.id);
    //             $('#edit_tag').val(data.name);
    //             $('#editTagModal').modal('show');
    //         },
    //         error: function(data, textStatus, xhr) {
    //             // sweet alert
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Error',
    //                 text: 'Sorry we were unable to find this record.',
    //             })
    //         },
    //     })
    //
    // });
    //
    // // Edit Tag
    // $('#editTag').submit(function(e) {
    //     e.preventDefault();
    //     let form = $('#editTag')[0];
    //     let formData = new FormData(form);
    //     $.ajax({
    //         url: baseUrl+'/updateTag',
    //         type: 'POST',
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //         success: function(data) {
    //             onSuccessRemoveEditErrors();
    //             $('#editTagModal').modal('hide');
    //             // sweet alert
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Success',
    //                 text: 'Tag updated successfully.',
    //             })
    //             table.ajax.reload();
    //         },
    //         error: function(error) {
    //             if(error.status === 422) {
    //                 refreshEditErrors();
    //                 var errors = $.parseJSON(error.responseText);
    //                 $.each(errors.errors, function(key, value) {
    //                     $('#'+key).addClass('is-invalid');
    //                     $('#'+ key +'_help').text(value[0]);
    //                 })
    //             }
    //         }
    //     })
    // })
    //
    // // Delete tag
    // $(document).on('click', '.deleteTag', function(e) {
    //     e.preventDefault();
    //     let id = $(this).attr('id');
    //
    //     Swal.fire({
    //         icon: 'warning',
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes, delete it!',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //
    //             $.ajax({
    //                 url: baseUrl+ '/deleteTag/'+id,
    //                 type: 'POST',
    //                 processData: false,
    //                 contentType: false,
    //                 success: function(data) {
    //                     // sweet alert
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: 'Success',
    //                         text: 'Tag deleted successfully.',
    //                     })
    //                     table.ajax.reload();
    //                 },
    //                 error: function(error) {
    //                     // sweet alert
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Error',
    //                         text: 'Sorry we were unable to find this record.',
    //                     })
    //                 }
    //             })
    //
    //         }
    //     })
    //
    //
    //
    //
    //
    // })
    //
    // // On success remove error - edit tag
    // function onSuccessRemoveEditErrors() {
    //     $('#edit_tag').removeClass('is-invalid');
    //     $('#edit_tag').val('');
    //     $('#edit_tag_help').text('');
    // }
    //
    // function refreshEditErrors() {
    //     $('#edit_tag').removeClass('is-invalid');
    //     $('#edit_tag_help').text('');
    // }
    //
    // $('#editTagModal').on('hidden.bs.modal', function() {
    //     onSuccessRemoveEditErrors();
    // })
    //
    // // On success remove error - add tag
    // function onSuccessRemoveErrors() {
    //     $('#tag_name').removeClass('is-invalid');
    //     $('#tag_name').val('');
    //     $('#tag_name_help').text('');
    // }
    //
    // function refreshErrors() {
    //     $('#tag_name').removeClass('is-invalid');
    //     $('#category_name_help').text('');
    // }
    //
    // $('#addTagModal').on('hidden.bs.modal', function() {
    //     onSuccessRemoveErrors();
    // })

});
