<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap 4 Grid Example</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .bordered-column {
      border: 1px solid black;
      height: 50px;
      text-align: center;
      line-height: 50px;
    }
  </style>
</head>

<body>
    <?php 
      // Include the navigation bar
      include 'navbar.php';
      include 'connection.php';  
    ?>
    
  <div class="container-fluid">

    <div class="row">
        <div class="col-4 bordered-column">
            1
        </div>
        <div class="col-8 bordered-column">
            2
        </div>

    </div>

    <div class="row">
      <div class="col bordered-column">1</div>
      <div class="col bordered-column">2</div>
      <div class="col bordered-column">3</div>
      <div class="col bordered-column">4</div>
      <div class="col bordered-column">5</div>
      <div class="col bordered-column">6</div>
      <div class="col bordered-column">7</div>
      <div class="col bordered-column">8</div>
      <div class="col bordered-column">9</div>
      <div class="col bordered-column">10</div>
      <div class="col bordered-column">11</div>
      <div class="col bordered-column">12</div>
    </div>

  <!-- Bootstrap JS (optional) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
