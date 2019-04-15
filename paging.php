<?php
function paging($sql,$item_per_page){
   $page          =  isset($_GET['page']) ? $_GET['page'] : 1 ; // halaman adalah didapat dari GET page. Jika tidak ada ya berarti halaman satu
   if( ( $page < 1) && (empty( $page ) ) ){
      $page=1; 
   }
   $query         = mssql_query( $sql );
   $jumlah_data   = mssql_num_rows($query);
   $jumlah_hal    = ceil( $jumlah_data/$item_per_page );
   if( $page>$jumlah_hal ){
      $page=$jumlah_hal;
   }
   $lanjut  = $page + 1;
   $sebelum = $page - 1;
   ?>
   Anda ada di halaman <?php echo $page;?> dari <?php echo $jumlah_hal;?><br />
   <a href="?page=1">&lt;&lt;</a>&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $sebelum; ?>">&lt;&nbsp;sebelumnya</a>&nbsp;&nbsp;&nbsp;
   ||
   &nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $lanjut;?>">selanjutnya&nbsp;&gt;</a>&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $jumlah_hal;?>">&gt;&gt;</a>
   Ke Halaman: <form action="" method="get"><input type="text" name="page"><input type="submit" value="Go"></form>
   <?php 
} 
?>