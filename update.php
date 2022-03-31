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
    <title>更新一筆資料錄，並且反應到特定資料庫中的特定資料表裡面。</title>

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

      $current_radius = $_REQUEST['radius_text'];
      $current_height = $_REQUEST['height_text'];
      $current_result = $_REQUEST['message_box02'];

      date_default_timezone_set("Asia/Taipei");
      $date_string = date("Y-m-d H:i:s");

      $sql = "UPDATE cylinder SET result = '$current_result', upload_time = '$date_string' WHERE radius = '$current_radius' AND height = '$current_height';";

      $output = mysqli_query($conn, $sql);

      if ($output)
      {
        echo '成功更新了此筆資料錄！';
      }
      else
      {
        echo '無法更新此筆資料錄...。';
      }

      mysqli_close($conn);
    ?>
  </body>
</html>
