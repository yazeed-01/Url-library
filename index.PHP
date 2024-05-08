<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/style.css" />
  </head>
  <body>
    <main class="app">
      <div class="cards">
        <div class="add card-style">
          <div class="plus">
            <i class="bx bx-plus"></i>
          </div>
          <h4> Add Url </h4>
        </div>
      </div>
    </main>
    <div class="popup-app">
      <div class="popup">
        <div class="header_popup">
          <i class="bx bx-x close"></i>
        </div>
        <form action="index.php" method="post">
          <div>
            <label>Url</label>
            <input name="url" type="text" />
            <label>Name</label>
            <input name="shortName" type="text" />
          </div>
          <button name = "submit">Submit</button>
        </form>
      </div>
    </div>

    <script src="./js/main.js"></script>
  </body>
</html>


<?php
        $conn = mysqli_connect('localhost', 'root', '', 'shorturls');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $shortName = $_POST['shortName']?? '';
        $url = $_POST['url']?? '';
        if(isset($_POST['submit'])) 
        {
            if($_POST['url'] == '') {
                echo "the input is empty";
            } 
            else {  
                $query = "INSERT INTO urls  VALUES ('$url' , '$shortName')";
                $result = mysqli_query($conn, $query);
                if ($result) 
                {
                header("Location: index.php");
                exit;
                } 
                else {
                echo "Error inserting data";
                }
                }
        }



        $query2 = "SELECT * FROM urls";
        $run_query2 = mysqli_query($conn, $query2);
        
        if (!$run_query2) {
            die("Failed to execute query: ". implode(", ", mysqli_error_list($conn)));
        }
        
        $count = 0;
        echo '<div style="white-space: nowrap;">'; //  keep all boxes in one row
        
        while ($row = mysqli_fetch_assoc($run_query2)) {
            $url = $row['url'];
            $shortName = $row['shortName'];
            echo <<<HTML
            <div style="display: inline-block; margin: 10px;">
                <div style="background-color: #fff; padding: 10px; border: 1px solid #ddd; border-radius: 10px;">
                    <a href="$url" target="_blank">
                        <h4 style="color: #000;">$$shortName</h4>
                    </a>
                </div>
            </div>
HTML;
            $count++;
            if ($count % 8 == 0) {
                echo '<br>'; // create a new line after every 8 boxes
            }
        }
        
        echo '</div>';
?>
