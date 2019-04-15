<!doctype html>
<html>
    <head>
        <title>Harviacode - Datatables</title>
        <link rel="stylesheet" href="assets_datatable/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets_datatable/css/dataTables.bootstrap.css"/>
    </head>
    <body>
        <div class="container">
            <table id="provinsi" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10%">Nomor</th>
                        <th width="15%">NPP</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

	include "include/config.php";
/*
                    //Data mentah yang ditampilkan ke tabel    
                    //mysqli_connect('localhost', 'root', '');
                    //mysqli_select_db('test');

$con=mysqli_connect("localhost","root","","test");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries

					
*/					
					
                    $sql = mssql_query("SELECT * FROM contoh");
                    $no = 1;
                    while ($r = mssql_fetch_array($sql)) {
                    $id = $r['ID'];
                    ?>

                    <tr align='left'>
                        <td><?php echo  $no;?></td>
                        <td><?php echo  $r['npp']; ?></td>
                        <td>
                            <a href="index.php?page=10d">Edit</a> | 
                            <a href="delete.php?id=<?php echo  $r['id_provinsi']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        
        <script src="assets_datatable/js/jquery-1.11.0.js"></script>
        <script src="assets_datatable/js/bootstrap.min.js"></script>
        <script src="assets_datatable/datatables/jquery.dataTables.js"></script>
        <script src="assets_datatable/datatables/dataTables.bootstrap.js"></script>
        <script type="text/javascript">
            $(function() {
                $("#provinsi").dataTable();
            });
        </script>
    </body>
</html>
