<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />

</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
               <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
               <a class="nav-link disabled" href="#">Disabled</a>
            </li>
         </ul>
      </div>
   </nav>

   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h2 class="text-center">Hello World</h2>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <h4>All user in database</h4>
         </div>
         <div class="col-md-6">
            <button class="btn btn-primary float-right mx-1" data-toggle="modal" data-target="#addModal">Add New User</button>
            <a href="action.php?export=excel" class="btn btn-success float-right">Export to Excel</a>
         </div>
      </div>
      <hr class="my-1">
      <div class="row">
         <div class="col-md-12">
            <div class="table-responsive" id="showUser">



            </div>
         </div>
      </div>
   </div>

   <!--Insert user The Modal -->
   <div class="modal fade" id="addModal">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
               <h4 class="modal-title">Add a User</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <form action="" method="post" id="form-data">
                  <div class="form-group">
                     <input type="text" name="fname" class="form-control" required placeholder="Fisrt name" aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                     <input type="text" name="lname" class="form-control" required placeholder="Last name" aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                     <input type="email" name="email" class="form-control" required placeholder="Email" aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                     <input type="tel" name="phone" class="form-control" required placeholder="phone" aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                     <input type="submit" name="insert" id="insert" value="Add User" class="btn btn-danger btn-block">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!--Edit user The Modal -->
   <div class="modal fade" id="editModal">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
               <h4 class="modal-title">Edit a User</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <form action="" method="post" id="edit-data">
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                     <input type="text" name="fname" id="fname" class="form-control" required aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                     <input type="text" name="lname" id="lname" class="form-control" required aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                     <input type="email" name="email" id="email" class="form-control" required aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                     <input type="tel" name="phone" id="phone" class="form-control" required aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                     <input type="submit" name="edit" id="edit" value="Edit User" class="btn btn-secondary btn-block">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery library -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!-- Popper JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <!-- Latest compiled JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

   <script>
      $(function() {

         function showUser() {
            $.ajax({
               url: './action.php',
               type: 'POST',
               data: {
                  action: 'view'
               },
               success: function(data) {
                  $('#showUser').html(data);
                  $('table').DataTable();
               }
            })
         }
         showUser();

         $('#insert').on('click', function(e) {
            if ($('#form-data')[0].checkValidity()) {
               e.preventDefault();
               $.ajax({
                  url: './action.php',
                  type: "POST",
                  data: $('#form-data').serialize() + "&action=insert",
                  success: function(data) {
                     Swal.fire({
                        title: 'Insert successfully!!',
                        icon: 'success'
                     })
                     $('#addModal').modal('hide');
                     $('#form-data')[0].reset();
                     showUser();
                  }
               })
            }
         })

         //edit user
         $('body').on('click', '.editBtn', function(e) {
            $id = $(this).attr('id');
            $.ajax({
               url: './action.php',
               type: 'POST',
               data: {
                  action: 'edit',
                  id: $id
               },
               success: function(data) {
                  $data = JSON.parse(data);
                  $('#id').val($data.id);
                  $('#fname').val($data.first_name);
                  $('#lname').val($data.last_name);
                  $('#email').val($data.email);
                  $('#phone').val($data.phone);
               }
            })
         })

         //update user

         $('#edit').on('click', function(e) {
            if ($('#edit-data')[0].checkValidity()) {
               e.preventDefault();
               $.ajax({
                  url: './action.php',
                  type: 'POST',
                  data: $('#edit-data').serialize() + '&action=update',
                  success: function(data) {
                     Swal.fire({
                        title: 'Update successfully!!',
                        icon: 'success'
                     })
                     $('#editModal').modal('hide');
                     $('#edit-data')[0].reset();
                     showUser();
                  }
               })
            }
         })

         //delete user
         $('body').on('click', '.deleBtn', function(e) {
            e.preventDefault();
            $id = $(this).attr('id');
            Swal.fire({
               title: 'Are you sure?',
               text: "You won't be able to revert this!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
               if (result.isConfirmed) {
                  $.ajax({
                     url: './action.php',
                     type: 'POST',
                     data: {
                        action: 'delete',
                        id: $id
                     },
                     success: function(data) {
                        Swal.fire(
                           'Deleted!',
                           'Your file has been deleted.',
                           'success'
                        )
                        showUser();
                     }
                  })
               }
            })
         })


         //detail user
         $('body').on('click', '.infoBtn', function(e) {
            $id = $(this).attr('id');
            $.ajax({
               url: './action.php',
               type: 'POST',
               data: {
                  action: 'detail',
                  id: $id
               },
               success: function(data) {
                  $data = JSON.parse(data);
                  Swal.fire({
                     title: '<strong>User Info: ID(' + $data.id + ')</strong>',
                     icon: 'info',
                     html: '<b>First Name : </b>' + $data.first_name + '</br><b>Last Name: </b>' + $data.last_name +
                        '</br><b>Email: </b>' + $data.email + '</br><b>Phone: </b>' + $data.phone,
                     showCancelButton: true
                  })
               }
            })
         });
      })
   </script>