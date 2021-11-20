$(document).ready(function () {

    var table = $('#msg').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        pageLength: 10,
        order: [0, 'desc'],
        "ajax" : {
            'url' : baseUrl+'/getAllMessage',
            // if data table has more than 5 columns then use type: POST method and pass data: token
            'type': 'POST',
            'data': {
                '_token' : $("meta[name='csrf-token']").attr('content')
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'message', name: 'message'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable:false},
            {data: 'action1', name: 'action1', orderable: false, searchable:false},
        ],

        "columnDefs" : [
            {
                "render": function (data, type, row, meta)
                {
                    return `<a href="#" class="btn btn-primary btn-sm viewMsg" id="${row.id}"> <i class="fas fa-eye"></i> </a> `
                },
                "targets" : 5
             },
            {
                "render": function (data, type, row, meta)
                {
                    return `<a href="#" class="btn btn-danger btn-sm deleteMsg" id="${row.id}">  <i class="far fa-trash-alt"></i>  </a> `
                },
                "targets" : 6
            },
            {
                "width" : "50%" , "targets" : 3,
            },
        ]

    });


    // Get contact message
    $(document).on('click', '.viewMsg', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: baseUrl+'/getMessage/'+id,
            type: 'GET',
            processData: false,
            contentType: false,
            success: function(data) {
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#message').val(data.message);
                $('#msgModal').modal('show');
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


    // Delete Contact Message
    $(document).on('click', '.deleteMsg', function(e) {
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
                    url: baseUrl+ '/deleteMessage/'+id,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // sweet alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Message deleted successfully.',
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
