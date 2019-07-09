<?php
/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */
require "../config.php";
require "../common.php";
if (isset($_POST['update'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"    => $_POST['id'],
      "name"  => $_POST['name'],
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
    $sql = "UPDATE users
            SET id = :id,
              name = :name,
              level = :level,
              age = :age,
              tshirt = :tshirt,
              docName = :docName,
              docPhone = :docPhone,
              medInfo = :medInfo,
              water = :water,
              walkRide = :walkRide,
              parentFirst = :parentFirst,
              parentLast = :parentLast,
              primaryPhone = :primaryPhone,
              primaryEmail = :primaryEmail,
              otherParentFirst = :otherParentFirst,
              otherParentLast = :otherParentLast,
              otherEmail = :otherEmail,
              otherPhone = :otherPhone,
              emergencyFirst = :emergencyFirst,
              emergencyLast = :emergencyLast,
              emergencyPhone = :emergencyPhone,
              address = :address,
              city = :city,
              state = :state,
              zipcode = :zipcode,
              resident = :resident,
              motherPickUp = :motherPickUp,
              fatherPickUp = :fatherPickUp,
              pickUpList = :pickUpList
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
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

<?php if (isset($_POST['update']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['name']); ?> successfully updated.</blockquote>
<?php endif; ?>

<form method="post" class="edit-form">
  <h2>Edit User</h2>
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <div class="form-group row">
    <label for="id" class="col-3">ID </label>
    <input class="col-6" type="text" name="id" id="id" value="<?php echo escape($user['id']); ?>" readonly> <br />
  </div>
  <div class="form-group row">
    <label for="name" class="col-3">Name </label>
    <input class="col-6" type="text" name="name" id="name" value="<?php echo escape($user["name"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="level" class="col-3">Level </label>
    <select class="col-6" name="level" id="level">
      <?php $the_key = escape($user["level"]);
        foreach(array(
          "Academy" => "Academy",
          "Junior" => "Junior",
          "Future Star" => "Future Stars",
          "Elite" => "Elite"
        ) as $key => $val){
          ?> <option value="<?php echo $key; ?>"<?php
            if($key==$the_key)echo ' selected="selected"';
            ?>><?php echo $val; ?></option><?php
        }
    ?></select> <br />
  </div>
  <div class="form-group row">
    <label for="age" class="col-3">Age </label>
    <input class="col-6" type="number" name="age" id="age" value="<?php echo escape($user["age"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="tshirt" class="col-3">T-Shirt </label>
    <input class="col-6" type="text" name="tshirt" id="tshirt" value="<?php echo escape($user["tshirt"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="docName" class="col-3">Doctor Name </label>
    <input class="col-6" type="text" name="docName" id="docName" value="<?php echo escape($user["docName"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="docPhone" class="col-3">Doctor Phone </label>
    <input class="col-6" type="text" name="docPhone" id="docPhone" value="<?php echo escape($user["docPhone"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="medInfo" class="col-3">Medical Info </label>
    <input class="col-6" type="text" name="medInfo" id="medInfo" value="<?php echo escape($user["medInfo"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="water" class="col-3">Water </label>
    <input class="col-6" type="text" name="water" id="water" value="<?php echo escape($user["water"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="walkRide" class="col-3">Walk/Ride </label>
    <input class="col-6" type="text" name="walkRide" id="walkRide" value="<?php echo escape($user["walkRide"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="parentFirst" class="col-3">Parent First </label>
    <input class="col-6" type="text" name="parentFirst" id="parentFirst" value="<?php echo escape($user["parentFirst"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="parentLast" class="col-3">Parent Last </label>
    <input class="col-6" type="text" name="parentLast" id="parentLast" value="<?php echo escape($user["parentLast"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="primaryEmail" class="col-3">Primary Email </label>
    <input class="col-6" type="text" name="primaryEmail" id="primaryEmail" value="<?php echo escape($user["primaryEmail"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="primaryPhone" class="col-3">Primary Phone </label>
    <input class="col-6" type="text" name="primaryPhone" id="primaryPhone" value="<?php echo escape($user["primaryPhone"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="otherParentFirst" class="col-3">Other Parent First </label>
    <input class="col-6" type="text" name="otherParentFirst" id="otherParentFirst" value="<?php echo escape($user["otherParentFirst"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="otherParentLast" class="col-3">Other Parent Last </label>
    <input class="col-6" type="text" name="otherParentLast" id="otherParentLast" value="<?php echo escape($user["otherParentLast"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="otherEmail" class="col-3">Other Email </label>
    <input class="col-6" type="text" name="otherEmail" id="otherEmail" value="<?php echo escape($user["otherEmail"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="otherPhone" class="col-3">Other Phone </label>
    <input class="col-6" type="text" name="otherPhone" id="otherPhone" value="<?php echo escape($user["otherPhone"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="emergencyFirst" class="col-3">Emergency First </label>
    <input class="col-6" type="text" name="emergencyFirst" id="emergencyFirst" value="<?php echo escape($user["emergencyFirst"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="emergencyLast" class="col-3">Emergency Last </label>
    <input class="col-6" type="text" name="emergencyLast" id="emergencyLast" value="<?php echo escape($user["emergencyLast"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="emergencyPhone" class="col-3">Emergency Phone </label>
    <input class="col-6" type="text" name="emergencyPhone" id="emergencyPhone" value="<?php echo escape($user["emergencyPhone"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="address" class="col-3">Address </label>
    <input class="col-6" type="text" name="address" id="address" value="<?php echo escape($user["address"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="city" class="col-3">City </label>
    <input class="col-6" type="text" name="city" id="city" value="<?php echo escape($user["city"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="state" class="col-3">State </label>
    <input class="col-6" type="text" name="state" id="state" value="<?php echo escape($user["state"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="zipcode" class="col-3">Zip Code </label>
    <input class="col-6" type="text" name="zipcode" id="zipcode" value="<?php echo escape($user["zipcode"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="resident" class="col-3">Resident </label>
    <input class="col-6" type="text" name="resident" id="resident" value="<?php echo escape($user["resident"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="motherPickUp" class="col-3">Mother Pick Up </label>
    <input class="col-6" type="text" name="motherPickUp" id="motherPickUp" value="<?php echo escape($user["motherPickUp"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="fatherPickUp" class="col-3">Father Pick Up </label>
    <input class="col-6" type="text" name="fatherPickUp" id="fatherPickUp" value="<?php echo escape($user["fatherPickUp"]); ?>"> <br />
  </div>
  <div class="form-group row">
    <label for="pickUpList" class="col-3">Pick Up List </label>
    <input class="col-6" type="text" name="pickUpList" id="pickUpList" value="<?php echo escape($user["pickUpList"]); ?>"> <br />
  </div>
  <input type="submit" name="update" value="update">
</form>

<?php require "templates/footer.php"; ?>
