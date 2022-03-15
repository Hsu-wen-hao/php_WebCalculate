<?php
$servername = 'localhost';
$username = 'francesco';
$password = 'good1234';
$dbname = 'calculations';

$conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>在特定資料庫中的特定資料表裡面，查詢特定資料錄。</title>

    <style>
      table
      {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td, th
      {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even)
      {
        background-color: #dddddd;
      }
    </style>
  </head>
  <body>
    <?php
      if (! $conn)
      {
        die('連線失敗：' . mysqli_connect_error());
      }
      else
      {
        echo "本次的連線成功了！<p></p>\n";
      }

      // http://localhost/database_related/examples/basic17.php?radius_text=16&height_text=18
      $current_radius = $_REQUEST['radius_text'];
      $current_height = $_REQUEST['height_text'];

      // $sql = 'SELECT id, radius, height, result FROM cylinder WHERE id = 2;';
      // $sql = 'SELECT id, radius, height, result FROM cylinder;';
      $sql = "SELECT id, radius, height, result FROM cylinder WHERE radius = '$current_radius' AND height = '$current_height';";

      $output = mysqli_query($conn, $sql);

      if (mysqli_num_rows($output) > 0)
      {
        echo "
    <table>
      <tr>
        <th>ID</th>
        <th>半徑</th>
        <th>高度</th>
        <th>計算結果</th>
      </tr>
        ";

        while ($row = mysqli_fetch_assoc($output))
        {
          //-0p echo '    id: ' . $row['id'] . ' - Radius: ' . $row['radius'] . ' - Height: ' . $row['height'] . ' - Result: ' . $row['result'] . "<br>\n";
          // echo "    ID: $row[id] - Radius: $row[radius] - Height: $row[height] - Result: $row[result]<br>\n";

          $new_result = str_replace("\n", '<br>', $row['result']);
          // $new_result = str_replace('　　', '', $new_result);

          echo "
      <tr>
        <td>$row[id]</td>
        <td>$row[radius]</td>
        <td>$row[height]</td>
        <td>$new_result</td>
      </tr>";
        }

        echo "</table>";
      }
      else
      {
        echo '查詢不到任何符合的資料錄...。';
      }

      mysqli_close($conn);
    ?>
  </body>
</html>