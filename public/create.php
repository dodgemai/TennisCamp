<?php
/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
require "../config.php";
require "../common.php";

if (isset($_POST['create'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
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
    );
    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['create']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['name']); ?> successfully added.</blockquote>
  <?php endif; ?>

<div class="add-form row">
  <form method="post" class="create-form">
    <h2>Add New Entry</h2>
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <div class="form-group row">
      <label for="name" class="col-3">Name </label>
      <input class="col-6" type="text" name="name" id="name"> <br />
    </div>
    <div class="form-group row">
      <label for="level" class="col-3">Level </label>
      <select class="col-6" name="level" id="level">
        <option selected></option>
        <option>Academy</option>
        <option>Junior</option>
        <option>Future Stars</option>
        <option>Elite</option>
      </select> <br />
    </div>
    <div class="form-group row">
      <label for="age" class="col-3">Age </label>
      <input class="col-6" type="number" name="age" id="age"> <br />
    </div>
    <div class="form-group row">
      <label for="tshirt" class="col-3">T-Shirt </label>
      <input class="col-6" type="text" name="tshirt" id="tshirt"> <br />
    </div>
    <div class="form-group row">
      <label for="docName" class="col-3">Doctor Name </label>
      <input class="col-6" type="text" name="docName" id="docName"> <br />
    </div>
    <div class="form-group row">
      <label for="docPhone" class="col-3">Doctor Phone </label>
      <input class="col-6" type="text" name="docPhone" id="docPhone"> <br />
    </div>
    <div class="form-group row">
      <label for="medInfo" class="col-3">Medical Info </label>
      <input class="col-6" type="text" name="medInfo" id="medInfo"> <br />
    </div>
    <div class="form-group row">
      <label for="water" class="col-3">Water </label>
      <input class="col-6" type="text" name="water" id="water"> <br />
    </div>
    <div class="form-group row">
      <label for="walkRide" class="col-3">Walk/Ride </label>
      <input class="col-6" type="text" name="walkRide" id="walkRide"> <br />
    </div>
    <div class="form-group row">
      <label for="parentFirst" class="col-3">Parent First </label>
      <input class="col-6" type="text" name="parentFirst" id="parentFirst"> <br />
    </div>
    <div class="form-group row">
      <label for="parentLast" class="col-3">Parent Last </label>
      <input class="col-6" type="text" name="parentLast" id="parentLast"> <br />
    </div>
    <div class="form-group row">
      <label for="primaryEmail" class="col-3">Primary Email </label>
      <input class="col-6" type="text" name="primaryEmail" id="primaryEmail"> <br />
    </div>
    <div class="form-group row">
      <label for="primaryPhone" class="col-3">Primary Phone </label>
      <input class="col-6" type="text" name="primaryPhone" id="primaryPhone"> <br />
    </div>
    <div class="form-group row">
      <label for="otherParentFirst" class="col-3">Other Parent First </label>
      <input class="col-6" type="text" name="otherParentFirst" id="otherParentFirst"> <br />
    </div>
    <div class="form-group row">
      <label for="otherParentLast" class="col-3">Other Parent Last </label>
      <input class="col-6" type="text" name="otherParentLast" id="otherParentLast"> <br />
    </div>
    <div class="form-group row">
      <label for="otherEmail" class="col-3">Other Email </label>
      <input class="col-6" type="text" name="otherEmail" id="otherEmail"> <br />
    </div>
    <div class="form-group row">
      <label for="otherPhone" class="col-3">Other Phone </label>
      <input class="col-6" type="text" name="otherPhone" id="otherPhone"> <br />
    </div>
    <div class="form-group row">
      <label for="emergencyFirst" class="col-3">Emergency First </label>
      <input class="col-6" type="text" name="emergencyFirst" id="emergencyFirst"> <br />
    </div>
    <div class="form-group row">
      <label for="emergencyLast" class="col-3">Emergency Last </label>
      <input class="col-6" type="text" name="emergencyLast" id="emergencyLast"> <br />
    </div>
    <div class="form-group row">
      <label for="emergencyPhone" class="col-3">Emergency Phone </label>
      <input class="col-6" type="text" name="emergencyPhone" id="emergencyPhone"> <br />
    </div>
    <div class="form-group row">
      <label for="address" class="col-3">Address </label>
      <input class="col-6" type="text" name="address" id="address"> <br />
    </div>
    <div class="form-group row">
      <label for="city" class="col-3">City </label>
      <input class="col-6" type="text" name="city" id="city"> <br />
    </div>
    <div class="form-group row">
      <label for="state" class="col-3">State </label>
      <input class="col-6" type="text" name="state" id="state"> <br />
    </div>
    <div class="form-group row">
      <label for="zipcode" class="col-3">Zip Code </label>
      <input class="col-6" type="text" name="zipcode" id="zipcode"> <br />
    </div>
    <div class="form-group row">
      <label for="resident" class="col-3">Resident </label>
      <input class="col-6" type="text" name="resident" id="resident"> <br />
    </div>
    <div class="form-group row">
      <label for="motherPickUp" class="col-3">Mother Pick Up </label>
      <input class="col-6" type="text" name="motherPickUp" id="motherPickUp"> <br />
    </div>
    <div class="form-group row">
      <label for="fatherPickUp" class="col-3">Father Pick Up </label>
      <input class="col-6" type="text" name="fatherPickUp" id="fatherPickUp"> <br />
    </div>
    <div class="form-group row">
      <label for="pickUpList" class="col-3">Pick Up List </label>
      <input class="col-6" type="text" name="pickUpList" id="pickUpList"> <br />
    </div>
       <button type="submit" class="btn btn-primary" name="create" value="create">Submit</button>
  </form>
</div>
<?php require "templates/footer.php"; ?>
