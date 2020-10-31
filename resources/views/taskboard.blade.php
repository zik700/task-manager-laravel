<!DOCTYPE html>
<html>
<head>
    <title>TaskManager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@300&display=swap" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px; display: flex; justify-content: center;">
            <a href="https://static.thenounproject.com/png/1596429-200.png"><img style="height: 57px;" src="https://static.thenounproject.com/png/1596429-200.png"></a>
            <span class="text-secondary" style="font-size:38px;justify-content:center; align-items: center;display: flex; margin-left: 16px; font-family: 'Pacifico', cursive; color: black !important" >Task Manager</span>
        </div>
        <div class="container-fluid" style="margin-top: 78px; display: flex; justify-content:center; margin-bottom: 32px;">
            <div class="row">
                <h4 class="one" style="font-size: 48px; font-family: 'Noto Sans SC', sans-serif;">Dashboard</h4> 
            </div>
        </div>
        <div class="container-fluid" id="daily-container" style="display:flex; font-size: 20px; margin-bottom: 32px;">
        <div class="di" style="display:flex; width: 100%">
                <div class="box" style="width:100%; display: flex;flex-direction: column; border-right: 1px solid black">
                    <div class="label" style="text-align: center; font-weight: bold;">
                        Daily
                    </div> 
                    <div class="tasks" style="font-style: italic">
                        <div class="div" style="display: flex;flex-direction: row;justify-content: space-between;">
                            <div class="done-tasks">
                                Done:
                            </div>
                            <div class="dz" style="margin-left: 10px; margin-right: 16px; /*! border-radius: 1px; */border: 1px solid black;/*! padding: 2px; */padding: 0 6px 0 6px;border-radius: 19px;/*! background: #a1bda1; */color: #0a370a; border-color: #28a745;" id="daily-done-counter">
                            </div>
                        </div>
                        <div class="div" style="display: flex;flex-direction: row;justify-content: space-between; padding-top: 6px;">
                            <div class="created-tasks">
                                Created:
                            </div>
                            <div class="dz" style="margin-left: 10px; margin-right: 16px; /*! border-radius: 1px; */border: 1px solid black;/*! padding: 2px; */padding: 0 6px 0 6px;border-radius: 19px;/*! background: #a1bda1; */color: #0a370a; border-color: #007bff;" id="daily-created-counter">

                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="container-fluid" id="weekly-container">
                    <div class="box" style="width:100%; display: flex;flex-direction: column;">
                    <div class="label" style="text-align: center; font-weight: bold;">
                            Monthly
                        </div> 
                        <div class="tasks" style="font-style: italic">
                        <div class="div" style="display: flex;flex-direction: row;justify-content: space-between;">
                            <div class="done-tasks">
                                Done:
                            </div>
                            <div class="dz" style="margin-left: 10px; margin-right: 16px; /*! border-radius: 1px; */border: 1px solid black;/*! padding: 2px; */padding: 0 6px 0 6px;border-radius: 19px;/*! background: #a1bda1; */color: #0a370a; border-color: #28a745;" id="monthly-done-counter">
                            </div>
                        </div>
                        <div class="div" style="display: flex;flex-direction: row;justify-content: space-between; padding-top: 6px;">
                            <div class="created-tasks">
                                Created:
                            </div>
                            <div class="dz" style="margin-left: 10px; margin-right: 16px; /*! border-radius: 1px; */border: 1px solid black;/*! padding: 2px; */padding: 0 6px 0 6px;border-radius: 19px;/*! background: #a1bda1; */color: #0a370a; border-color: #007bff;" id="monthly-created-counter">

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="bottom-div" style="display: flex;justify-content: center;width: 100%; margin-bottom: 32px;">
                <button class="btn btn-outline-primary" style="width:50%" id="createNewBook">New Task</button>
            </div>
        <br>
        <table id="dataTable" class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Deadline</th>
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
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Deadline</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="deadline" name="deadline"
                                    placeholder="Enter deadline"
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

<script type="text/javascript" >

    $(function () {
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $(document).ready(function(){
            $.ajax({
                url: "{{ url('taskboard') }}" + '/dailydone',
                type: "GET",
                data: "<div> Replace div with this contentf</div>",
                success: function(data){
                    $('#daily-done-counter').html(data);
                }
            })
        });

        $(document).ready(function(){
            $.ajax({
                url: "{{ url('taskboard') }}" + '/dailycreated',
                type: "GET",
                data: "<div> Replace div with this contentf</div>",
                success: function(data){
                    $('#daily-created-counter').html(data);
                }
            })
        });

        $(document).ready(function(){
            $.ajax({
                url: "{{ url('taskboard') }}" + '/monthlydone',
                type: "GET",
                data: "<div> Replace div with this contentf</div>",
                success: function(data){
                    $('#monthly-done-counter').html(data);
                }
            })
        });

        $(document).ready(function(){
            $.ajax({
                url: "{{ url('taskboard') }}" + '/monthlycreated',
                type: "GET",
                data: "<div> Replace div with this contentf</div>",
                success: function(data){
                    $('#monthly-created-counter').html(data);
                }
            })
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
                {data: 'deadline', name: 'deadline'},
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
            console.log($('#bookForm').serialize());

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
                    console.log(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                    console.log(data)
                }
            });

            $.ajax({
                url: "{{ url('taskboard') }}" + '/dailydone',
                type: "GET",
                data: "<div> Replace div with this contentf</div>",
                success: function(data){
                    $('#daily-done-counter').html(data);
                }
            })

            $.ajax({
                url: "{{ url('taskboard') }}" + '/dailycreated',
                type: "GET",
                data: "<div> Replace div with this contentf</div>",
                success: function(data){
                    $('#daily-created-counter').html(data);
                }
            })
            

        });

        // EDIT TASK
        $('body').on('click', '.editBook', function () {
            var id = $(this).data('id');
            $.get("{{ url('taskboard') }}" + '/' + id + '/edit', function (data) {
                $('#modelHeading').html("Edit Book");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#deadline').val(data.deadline);
            })
        });

        // DONE TASK
        $('body').on('click', '.doneBtn', function () {
            var id = $(this).data("id");
           
            if(confirm("Are you sure done this task?")){
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
            }
            
            // RELOAD 
            $.ajax({
                url: "{{ url('taskboard') }}" + '/dailydone',
                type: "GET",
                data: "<div> Replace div with this contentf</div>",
                success: function(data){
                    $('#daily-done-counter').html(data);
                }
            })
           
        });

        // DELETE TASK
        $('body').on('click', '.deleteBook', function () {
            var id = $(this).data("id");
            if (confirm("Are you sure delete this task?")){
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
            }
        });
        

    });
</script>
</html>