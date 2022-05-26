<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <link  rel="icon"   href="assets/img/favicon.png" type="image/png" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="http://localhost/EP/config/js/functions.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://localhost:8080/EP/config/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="http://localhost:8080/EP/config/css/normalize.css">
    <link rel="stylesheet" href="http://localhost:8080/EP/config/css/style.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="//cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json"></script> -->

    <link href="http://localhost:8080/EP/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
        }
    }
    </style>

    <link href="http://localhost:8080/EP/config/css/sidebars.css" rel="stylesheet">
    <title><?= esc($title) ?></title>
    <script>
        $(document).ready(function () {
          $('#example').DataTable({
            "pageLength": 5,
            "searching": true,
            "lengthChange": false,
          });
        });
    </script>
    <script type = "text/javascript">  
            function badlogin() {  
              Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Parece que tus credenciales no son correctas!',
            })  
            }  
      </script>   
</head>