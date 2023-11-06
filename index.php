<!DOCTYPE html>
<html>
<head>
<style>
 .prime {
    background-color: green;
        }
  .number-box {
    display: inline-block;
    padding: 10px;
    border: 1px solid #ccc;
    margin-right: 5px;
    background: white;
   }

  .prime-box {
    background-color: green;
      }
  </style>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="myForm" method="post">
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<div class="form-group">';
                echo '<input type="text" id="number' . $i . '" name="numbers[] ">';
                echo '</div>';
            }
            ?>
            <div class="form-group">
                <label for="sortOrder">Sort Order:</label>
                <select id="sortOrder" name="sortOrder">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <button type="submit" name="submit">Sort Data</button>
            <button type="button" id="randomButton">Fill Random Data</button>
        </form>
    </div>
    <div class="container" id="resultContainer">
        <h2>Results</h2>
        <ul id="sortedNumbers">
  <?php
     if (isset($_POST['submit'])) {
      $numbers = $_POST['numbers'];

        $validationError = false;
          foreach ($numbers as $num) {
              if (!is_numeric($num)) {
                 $validationError = true;
                    break;
           }
     }

          if ($validationError) {
                echo '<p style="color: red;">Please enter valid numbers.</p>';
               } else {
                    $sortOrder = $_POST['sortOrder'];

                    if ($sortOrder === 'asc') {
                        sort($numbers);
                    } elseif ($sortOrder === 'desc') {
                        rsort($numbers);
                    }

                    foreach ($numbers as $num) {
                        echo '<div class="number-box';
                        if (isPrime($num)) {
                            echo ' prime-box';
                        }
                        echo '">' . $num . '</div>';
                    }
                }
            }

            function isPrime($num) {
                if ($num <= 1) return false;
                if ($num <= 3) return true;
                if ($num % 2 === 0 || $num % 3 === 0) return false;
                for ($i = 5; $i * $i <= $num; $i += 6) {
                    if ($num % $i === 0 || $num % ($i + 2) === 0) return false;
                }
                return true;
            }
            ?>
        </ul>
    </div>
    <script>
        $('#randomButton').click(function() {
            for (let i = 1; i <= 10; i++) {
                const input = $('#number' + i);
                const randomNum = Math.floor(Math.random() * 100);
                input.val(randomNum);
            }
        });
    </script>
    </body>
</html>