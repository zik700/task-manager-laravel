<!DOCTYPE html>
<html>
<head>
    <title>TaskManager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <a href="https://static.thenounproject.com/png/1596429-200.png"><img style="height: 75px;" src="https://static.thenounproject.com/png/1596429-200.png"></a><br>
            <span class="text-secondary">Task Manager</span>
        </div>
        <div class="container-fluid">
            <div class="row">
                <h4 class="one">Tasks list</h4>
                <button class="btn btn-outline-primary ml-auto" id="createNewBook">New Task</button>
            </div>
        </div>
        <div class="container-fluid">
            <h4 class="one">Daily done: </h4>
            <h3 class="one" id="dailyCounter">0</h3>
        </div>
        <br>
        <table id="dataTable" class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th width="280px">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    {{-- create/update book modal--}}
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="bookForm" name="bookForm" class="form-horizontal">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                    value="" maxlength="50" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="description" name="description"
                                    placeholder="Enter author name"
                                    value="" maxlength="50" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script type="text/javascript">
    $(function () {
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('taskboard') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // create new task
        $('#createNewBook').click(function () {
            $('#saveBtn').html("Create");
            $('#id').val('');
            $('#bookForm').trigger("reset");
            $('#modelHeading').html("Create New Book");
            $('#ajaxModel').modal('show');
        });

        // create or update task
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..');

            $.ajax({
                data: $('#bookForm').serialize(),
                url: "{{ url('taskboard') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#bookForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    $('#saveBtn').html('Save');
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });

        // edit task
        $('body').on('click', '.editBook', function () {
            var id = $(this).data('id');
            $.get("{{ url('taskboard') }}" + '/' + id + '/edit', function (data) {
                $('#modelHeading').html("Edit Book");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
            })
        });

        $('body').on('click', '.doneBtn', function () {
            var id = $(this).data("id");
            confirm("Jesteś pewny, że chcesz załatwić to zadanie?");

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "{{ url('') }}" + '/done/' + id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        // delete task
        $('body').on('click', '.deleteBook', function () {
            var id = $(this).data("id");
            confirm("Jesteś pewny, że chcesz usunąć to zadanie?");

            $.ajax({
                type: "DELETE",
                url: "{{ url('taskboard') }}" + '/' + id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });
</script>
</html>