<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CDN copied from https://getbootstrap.com/docs/4.1/getting-started/introduction/ -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Tennis Academy Database</title>

    <link rel="stylesheet" href="css/style.css" />

  </head>

  <body>
    <div class="container-fluid">

    <header>
      <h1>Rob Nickels Tennis Academy Database</h1>
    </header>

    <!-- <nav class="navbar">
      <a href="create.php">+</a>
      <a href="read.php">Read</a>
      <a href="update.php">Update</a>
      <a href="delete.php">Delete</a>
    </nav> -->
    <nav class="navbar justify-content-between">
      <div class="search">
        <div class="back"><a href="index.php"><button type="submit" class="btn btn-link" onclick="index.php">Back</button></a></div>
        <form class="form-inline" method="post" action="search.php">
          <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
          <input class="form-control" type="text" id="name" name="name" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit" value="Search">Search</button>
        </form>
        <form class="form-inline" style="float: left;" method="post" action="filter.php">
          <select class="custom-select" id="inputGroupSelect" name="level">
            <option selected>Choose...</option>
            <option value="Academy">Academy</option>
            <option value="Junior">Junior</option>
            <option value="Future Stars">Future Stars</option>
            <option value="Elite">Elite</option>
          </select>
          <button class="btn btn-outline-success my-2 my-sm-0" name="submit" type="submit">Filter</button>
        </form>
        <div class="add"><a href="create.php"><button type="submit" class="btn btn-link">+</button></a></div>
      </div>
    </nav>

  </div>
    <!-- CDN links copied from https://getbootstrap.com/docs/4.1/getting-started/introduction/ -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>
