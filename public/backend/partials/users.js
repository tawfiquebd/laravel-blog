$(document).ready(function () {

    var table = $('#allUsers').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        pageLength: 10,
        order: [0, 'asc'],
        "ajax" : {
            'url' : baseUrl+'/getAllUsers',
            'type': 'POST',
            'data': {
              '_token' : $("meta[name='csrf-token']").attr('content')
            },
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable:false},
        ],

        "columnDefs" : [
            {
                "render": function (data, type, row, meta)
                {
                    return `<a href="#" class="btn btn-danger btn-sm deleteUser" id="${row.id}">  <i class="far fa-trash-alt"></i>  </a> `
                },
                "targets" : 5
            },
        ]

    });


    // Delete user
    $(document).on('click', '.deleteUser', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');

        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete user!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    url: baseUrl+ '/deleteUser/'+id,
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // sweet alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User deleted successfully.',
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
