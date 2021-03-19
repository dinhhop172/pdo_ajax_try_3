<?php

include_once './database.php';

$db = new database();
if (isset($_POST['action']) && $_POST['action'] == 'view') {
   $output = '';
   $data = $db->read();
   if ($db->totalCountRow() > 0) {
      $output .= "<table class='table table-sm'>
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Fist Name</th>
                           <th>Last Name</th>
                           <th>E-Mail</th>
                           <th>Phone</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>";
      foreach ($data as $row) {
         $output .= "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['first_name'] . "</td>
                        <td>" . $row['last_name'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['phone'] . "</td>
                        <td>
                           <a href='#' class='btn btn-info infoBtn' id='" . $row['id'] . "'>Detail</a>
                           <a href='#' class='btn btn-secondary editBtn' id='" . $row['id'] . "' data-toggle='modal' data-target='#editModal'>Edit</a>
                           <a href='#' class='btn btn-danger deleBtn' id='" . $row['id'] . "'>Delete</a>
                        </td>
                     </tr>";
      }
      $output .= " </tbody>
               </table>";
      echo $output;
   }
}

if (isset($_POST['action']) && $_POST['action'] == 'insert') {
   $fname = htmlspecialchars($_POST['fname']);
   $lname = htmlspecialchars($_POST['lname']);
   $email = htmlspecialchars($_POST['email']);
   $phone = htmlspecialchars($_POST['phone']);

   $db->insert($fname, $lname, $email, $phone);
}

if (isset($_POST['action']) && $_POST['action'] == 'edit') {
   $id = $_POST['id'];
   $data = $db->getUserId($id);
   echo json_encode($data);
}

if (isset($_POST['action']) && $_POST['action'] == 'update') {
   $id = $_POST['id'];
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];

   $db->update($id, $fname, $lname, $email, $phone);
}


if (isset($_POST['action']) && $_POST['action'] == 'delete') {
   $id = $_POST['id'];
   $db->delete($id);
}

if (isset($_POST['action']) && $_POST['action'] == 'detail') {
   $id = $_POST['id'];
   $data = $db->getUserId($id);
   echo json_encode($data);
}


if (isset($_GET['export']) && $_GET['export'] == 'excel') {
   header("Content-Type: application/xls");
   header("Content-Disposition: attachment; filename: users.xls");
   header("Pragma: no-cache");
   header("Expires: 0");

   $data = $db->read();
   echo "<table border='1'>";
   echo '<tr><th>Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th>';

   foreach ($data as $row) {
      echo '<tr>
               <td>' . $row['id'] . '</td>
               <td>' . $row['first_name'] . '</td>
               <td>' . $row['last_name'] . '</td>
               <td>' . $row['email'] . '</td>
               <td>' . $row['phone'] . '</td>
            </tr>';
   }
   echo '</table>';
}
