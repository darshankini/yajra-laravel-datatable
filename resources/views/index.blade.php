
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <title>Laravel DataTables Editor</title>
 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
        <link rel="stylesheet" href="css/editor.dataTables.css">
        <link rel="stylesheet" href="css/editor.bootstrap.css">
 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/select/2.0.2/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
        <script src="{{asset('js/dataTables.editor.js')}}"></script>
 
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.min.js"></script>
 
        <script src="{{asset('js/editor.bootstrap.min.js')}}"></script>
        <style>
            .datatable-div{
                border: 5px outset #033b55;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        
        <div class="container">
        <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#" style="min-height: 200px;">
            <img src="https://yajrabox.com/img/logo.min.svg" alt="">
            <h1 class="font-bold dark:text-gray-400">Laravel DataTables</h1>
        </a>
        </nav>
        <div class="datatable-div">
            {{$dataTable->table(['id' => 'users'])}}
        </div>
        </div>
 
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });
 
                var editor = new $.fn.dataTable.Editor({
                    ajax: "/users",
                    table: "#users",
                    display: "bootstrap",
                    fields: [
                        {label: "Name:", name: "name"},
                        {label: "Email:", name: "email"},
                        {label: "Password:", name: "password", type: "password"}
                    ]
                });
 
                $('#users').on('click', 'tbody td:not(:first-child)', function (e) {
                    editor.inline(this);
                });
 
                {{$dataTable->generateScripts()}}
            })
        </script>
    </body>
</html>