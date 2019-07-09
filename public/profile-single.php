<?php

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id" => $_POST['id'],
      "name" => $_POST['name'],
      "level" => $_POST['level'],
      "age" => $_POST['age'],
      "tshirt" => $_POST['tshirt'],
      "docName" => $_POST['docName'],
      "docPhone" => $_POST['docPhone'],
      "medInfo" => $_POST['medInfo'],
      "water" => $_POST['water'],
      "walkRide" => $_POST['walkRide'],
      "parentFirst" => $_POST['parentFirst'],
      "parentLast" => $_POST['parentLast'],
      "primaryEmail" => $_POST['primaryEmail'],
      "primaryPhone" => $_POST['primaryPhone'],
      "otherParentFirst" => $_POST['otherParentFirst'],
      "otherParentLast" => $_POST['otherParentLast'],
      "otherEmail" => $_POST['otherEmail'],
      "otherPhone" => $_POST['otherPhone'],
      "emergencyFirst" => $_POST['emergencyFirst'],
      "emergencyLast" => $_POST['emergencyLast'],
      "emergencyPhone" => $_POST['emergencyPhone'],
      "address" => $_POST['address'],
      "city" => $_POST['city'],
      "state" => $_POST['state'],
      "zipcode" => $_POST['zipcode'],
      "resident" => $_POST['resident'],
      "motherPickUp" => $_POST['motherPickUp'],
      "fatherPickUp" => $_POST['fatherPickUp'],
      "pickUpList" => $_POST['pickUpList']
    ];
    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute($user);
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

  <div class="profile-page row">
    <div class="row profile-name"><h2><?php echo $user["name"]?></h2></div>
    <div class="row edit"><a href="update-single.php?id=<?php echo escape($user["id"]); ?>">Edit</a></div>
    <div class="camper-info row">
      <div class="row"><h4>Camper Information</h4></div>
      <div class="row"><p>Age: <?php echo escape($user["age"]); ?></p></div>
      <div class="row"><p>Level: <?php echo escape($user["level"]); ?></p></div>
      <div class="row"><p>T-Shirt: <?php echo escape($user["tshirt"]); ?></p></div>
      <div class="row"><p>Water activities: <?php echo escape($user["water"]); ?></p></div>
      <div class="row"><hr /></div>
    </div>
    <div class="emergency row">
      <div class="row"><h4>Emergency</h4></div>
      <div class="row"><p>Emergency contact: <?php echo escape($user["emergencyFirst"]) ." ". escape($user["emergencyLast"]); ?></p></div>
      <div class="row"><p>Emergency phone: <?php echo escape($user["emergencyPhone"]); ?></p></div>
      <div class="row"><hr /></div>
    </div>
    <div class="medical row">
      <div class="row"><h4>Medical</h4></div>
      <div class="row"><p>Medical information: <?php echo escape($user["medInfo"]); ?></p></div>
      <div class="row"><p>Doctor: <?php echo escape($user["docName"]); ?></p></div>
      <div class="row"><p>Doctor phone: <?php echo escape($user["docPhone"]); ?></p></div>
      <div class="row"><hr /></div>
    </div>
    <div class="parent-info row">
      <div class="first-parent col">
        <div class="row"><h4>1st Parent Info</h4></div>
        <div class="row"><p>Parent: <?php echo escape($user["parentFirst"]) ." ". escape($user["parentLast"]); ?></p></div>
        <div class="row"><p>Primary phone: <?php echo escape($user["primaryPhone"]); ?></p></div>
        <div class="row"><p>Primary email: <?php echo escape($user["primaryEmail"]); ?></p></div>
      </div>
      <div class="second-parent col">
        <div class="row"><h4>2nd Parent Info</h4></div>
        <div class="row"><p>Parent: <?php echo escape($user["otherParentFirst"]) ." ". escape($user["otherParentLast"]); ?></p></div>
        <div class="row"><p>Other phone: <?php echo escape($user["otherPhone"]); ?></p></div>
        <div class="row"><p>Primary email: <?php echo escape($user["otherEmail"]); ?></p></div>
      </div>
      <div class="row"><p>Address: <?php echo escape($user["address"]); ?>, <?php echo escape($user["city"]); ?>, <?php echo escape($user["state"]); ?> <?php echo escape($user["zipcode"]); ?></div>
      <div class="row"><hr /></div>
    </div>
    <div class="pick-up row">
      <div class="row"><h4>Pick-Up</h4></div>
      <div class="row"><p>Can mother pick up child from camp? <?php echo escape($user["motherPickUp"]); ?></p></div>
      <div class="row"><p>Can father pick up child from camp? <?php echo escape($user["fatherPickUp"]); ?></p></div>
      <div class="row"><p>Other people authorized to pick up: <?php echo escape($user["pickUpList"]); ?></p></div>
      <div class="row"><p>Can child walk or ride home from camp? <?php echo escape($user["walkRide"]); ?></p></div>
    </div>

<?php require "templates/footer.php"; ?>
