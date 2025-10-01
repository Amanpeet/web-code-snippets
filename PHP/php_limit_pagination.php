<style>

/*PAGINATION STYLE*/
.mini-pagination{
  text-align: right;
  padding: 6px 0px;
}
.mini-pagination > a {
  background: #DCDCDC;
  border: 1px solid #B7B7B7;
  display: inline-block;
  margin-left: 6px;
  margin-bottom: 6px;
  padding: 3px 6px;
  text-align: right;
}
.mini-pagination > a:hover {
  background: #D4D4D4;
  text-decoration: none;
}

</style>


<?php

      //pagination part 1
      $num_rec_per_page = 30;

      if (isset($_GET["pagex"])) {
        $pagex = $_GET["pagex"];
      } else {
        $pagex = 1;
      }

      echo " Page: ".$pagex;
      $start_from = ($pagex - 1) * $num_rec_per_page;

      $sql = "SELECT DISTINCT customerid, CheckDate, AccNumber, Fullname, Amount, CurBalance, Status, Lastcall FROM PFGrem.Payments WHERE ClientID='$user_id' AND Package LIKE '$selectedPackage' group by CustomerID ORDER BY Lastcall DESC LIMIT $num_rec_per_page OFFSET $start_from";
      $stmt = sqlsrv_query( $conn, $sql );

      if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
      }

      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
      <tr class="">
        <td><?php echo $row['AccNumber'];?></td>
        <td><?php echo $row['customerid'];?></td>
        <td><?php echo $row['Fullname'];?></td>
        <td><?php echo '$' . number_format($row['Amount'], 2); ?></td>
        <td><?php echo '$' . number_format($row['CurBalance'], 2); ?></td>
        <td><?php echo $row['Status'];?></td>
        <td><?php echo date_format($row['Lastcall'],'F j, Y');?></td>
      </tr><?php
      }

      //pagination part 2
      $sql = "SELECT COUNT(DISTINCT customerid) AS countx FROM PFGrem.Payments WHERE ClientID='$user_id' AND Amount > 0 AND Package LIKE '$selectedPackage' ";
      $stmt = sqlsrv_query( $conn, $sql );
      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $total_records = $row['countx'];
      }
      $total_pages   = ceil($total_records / $num_rec_per_page);

      echo "<div class='mini-pagination'>";
      //for first page
      $new_data = array("pagex" => "1");
      $full_data = array_merge($_GET, $new_data);
      $url = http_build_query($full_data);            
      echo "<a href=?$url> First </a> ";

      //for each page
      if( $total_pages > 10 ){
        $i = $pagex;
        $min_pages = $i + 10 ;
        if( $min_pages >= $total_pages ){
          $i = $total_pages - 10;
          $min_pages = $i + 10 ;
        }
        for ( $i; $i <= $min_pages; $i++) {
          $new_data = array( "pagex" => $i );
          $full_data = array_merge($_GET, $new_data);
          $url = http_build_query($full_data);
          if( $pagex == $i ){
            echo "<a class='active' href=?$url>" . $i . "</a>";
          } else {
            echo "<a href=?$url>" . $i . "</a>";
          }
        }

        //dots to next page
        if( ! ($min_pages >= $total_pages-10) ){
          $new_data = array( "pagex" => $min_pages+1 );
          $full_data = array_merge($_GET, $new_data);
          $url = http_build_query($full_data);
          echo "<a href=?$url> ... </a> ";
        }
      } else {
        for ( $i=1; $i <= $total_pages; $i++) {
          $new_data = array( "pagex" => $i );
          $full_data = array_merge($_GET, $new_data);
          $url = http_build_query($full_data);
          if( $pagex == $i ){
            echo "<a class='active' href=?$url>" . $i . "</a>";
          } else {
            echo "<a href=?$url>" . $i . "</a>";
          }
        }
      }

      //last page
      $new_data = array("pagex" => $total_pages);
      $full_data = array_merge($_GET, $new_data);
      $url = http_build_query($full_data);
      echo "<a href=?$url> Last </a> ";

      echo "</div>";

?>