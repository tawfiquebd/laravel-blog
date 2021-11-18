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
                    return `<a href="#" class="btn btn-danger btn-sm deleteCategory" id="${row.id}">  <i class="far fa-trash-alt"></i>  </a> `
                },
                "targets" : 5
            },
        ]

    });


});
