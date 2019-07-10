<?php
require "../config.php";
require "../common.php";

if (isset($_POST['export'])) {
  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT * FROM weekly";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    $filename = "WeeklyReport.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($result)) {
        foreach ($result as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
  }
  catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
