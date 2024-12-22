<html>

<head>
</head>

<body>
    <h2>Save Your Data</h2>
    <form action="home.php" method="post">
        <label for="ID">ID:</label>
        <input type="text" ID="ID" Name="ID">
        <label for="Name">Name:</label>
        <input type="text" ID="Name" Name="Name">
        <label for="Address">Address:</label>
        <input type="text" ID="Address" Name="Address">
        <input type="submit" value="Save" Name="Save">
        <input type="submit" value="Edit" Name="Edit">
        <input type="submit" value="Delete" Name="Delete">
        <input type="submit" value="Display" Name="Display">
    </form>
</body>

</html>



<?php
if (isset($_POST['Save'])) {
  $ID = $_POST['ID'];
  $Name = $_POST['Name'];
  $Address = $_POST['Address'];
  require_once 'connection.php';
  $result = mysqli_query($link, "INSERT INTO  Student (`ID`,`Name`, `Address`)  
VALUES ('$ID','$Name','$Address')");
  header('Location:home.php');
  echo "<h3> Data saved Successfuly </h3>";
  mysqli_close($link);
}
if (isset($_POST['Edit'])) {
  $ID = $_POST['ID'];
  $Name = $_POST['Name'];
  $Address = $_POST['Address'];
  require_once 'connection.php';
  $sql1 = ("update Students set Name= '$Name' WHERE ID like '$ID'");
  $result = mysqli_query($link, $sql1);
  $sql2 = ("update Students set Address= '$Address' WHERE ID like '$ID'");
  $result = mysqli_query($link, $sql2);
  header('Location:home.php');
  mysqli_close($link);
}
if (isset($_POST['Delete'])) {
  $ID = $_POST['ID'];
  require_once 'connection.php';
  $result = mysqli_query($link, "DELETE FROM  Students where ID =$ID");
  header('Location:home.php');
  mysqli_close($link);
}

if (isset($_POST['Display'])) {
  require_once 'connection.php';
  $sql = ("SELECT * FROM Students");
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  if ($count == 0) {
    echo "<No result matches </h3>";
  } else {
    echo "<table border=1> 
                            <tr> 
                                 <th >ID</th> 
                                 <th >Name</th> 
                                  <th >Address</th>                                                        
                            </tr>";
    for ($i = 0; $i < $count; $i++) {
      $ID = $data[$i]["ID"];
      $Name = $data[$i]["Name"];
      $Address = $data[$i]["Address"];
      echo "<tr>";
      echo "<td>" . $ID . "</td>";
      echo "<td>" . $Name . "</td>";
      echo "<td>" . $Address . "</td>";
    }
    echo "</table>";
  }
}
?>