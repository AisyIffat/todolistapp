<?php
  // put backend code before rendering all the html elements

  // Connect to Database
  // 1. database info
  $host = "127.0.0.1";
  $database_name = "todolist_app"; // connecting to which database
  $database_user = "root";
  $database_password = "";

  // 2. connect PHP with the MySQL database
  // PDO (PHP Database Object)
  $database = new PDO(
    "mysql:host=$host;dbname=$database_name", // host and db name 
    $database_user, // username
    $database_password // password
  );

  // 3. get the students data from the database
  // 3.1 - SQL command(recipe)
  $sql = "SELECT * FROM todos";
  // 3.2 - prepare SQL query (prepare your material)
  $query = $database->prepare( $sql );
  // 3.3 - execute the SQL query (cook it)
  $query->execute();
  // 3.4 - fetch all the results from the query (eat)
  $todos = $query->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
          <?php
          foreach ($todos as $index => $todo) { ?>
            <li
            class="list-group-item d-flex justify-content-between align-items-center"
            >
            <div>
            <form method="POST" action="e1-update.php">
              <input type="hidden" name="list_id" value="<?php echo $todo["id"]; ?>"/>
              <input type="hidden" name="list_completed" value="<?php echo $todo["completed"]; ?>"/>
                <?php if ($todo["completed"] == 0){ ?>
                  <button class = "btn btn-sm btn-light"><i class="bi bi-square"></i></button>
                  <span class="ms-2"><?php echo $todo["label"]; ?></span> 
                <?php } else {?>
                  <button class="btn btn-sm btn-success">
                    <i class="bi bi-check-square"></i>
                  </button>
                  <span class="ms-2 text-decoration-line-through"><?php echo $todo["label"]; ?></span>
                <?php } ?>
              </form>
            </div>
            <div>
              <form 
                  method="POST" 
                  action="e1-delete.php"
                  >
                  <!-- hidden input is to pass required data to the backend -->
                  <input type="hidden" name="list_id" value="<?php echo $todo["id"]; ?>"/>
                  <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
              </form>  
            </div>
          </li>
          <?php } ?>
        </ul>
        <div class="mt-4">
          <form method="POST" action="e1-add.php" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="list_label" 
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
