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
                    return `<a href="#" class="btn btn-danger btn-sm deleteBlog" id="${row.id}">  <i class="far fa-trash-alt"></i>  </a> `
                },
                "targets" : 9
            },
        ]

    });


    // Delete Blog
    $(document).on('click', '.deleteBlog', function(e) {
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
                    url: baseUrl+ '/deleteBlog/'+id,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // sweet alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Tag deleted successfully.',
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



});
