<?php
include './DbConnection.php';


    $conn = DbConnection::getInstance();
    $conn = $conn->getConnection();
    $sql = "SELECT * FROM USER";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $txt = "";
    $txt .='<table class="mitabla">';
    $txt .= "<tr><th>Email</th><th>Password</th><th>Nombre</th></tr>";
    
    foreach ($results as $row) {
        $txt .= "<tr>";
        $txt .= "<td>{$row['EMAIL']}</td>";
        $txt .= "<td>{$row['PASSWORD']}</td>";
        $txt .= "<td>{$row['NAME']}</td>";
        $txt .= "</tr>";
    }

    $txt .= "</table>";

    $sql = "SELECT * FROM TOKENS";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $txt .= "";
    $txt .='<table class="mitabla">';
    $txt .= "<tr><th>ID</th><th>Token</th><th>UserID</th><th>Expires</th></tr>";

    
    foreach ($results as $row) {
        $txt .= "<tr>";
        $txt .= "<td>{$row['ID']}</td>";
        $txt .= "<td>{$row['TOKEN']}</td>";
        $txt .= "<td>{$row['USERID']}</td>";
        $txt .= "<td>{$row['EXPIRES']}</td>";
        $txt .= "</tr>";
    }

    $txt .= "</table>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver BD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
  <link rel="stylesheet" type="text/css" href="../css/verBD.css">
</head>
<body>
    <header id="header">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="d-flex align-items-center">
          <a class="textoCabecera" href="./index.php" id="logo">Parque de Atracciones </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="./cuenta.php">Cuenta</a></li>
            <li class="nav-item"><a class="nav-link" href="./verBD.php">ver BD</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <div id="pagina">
        <div class="bloque">
            <?php echo $txt ?>

        </div>
    </div>

    
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" defer></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>