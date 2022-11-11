<?php
    require 'components/header.php'; 
?>
<div>
<h1>List of feedbacks here</h1>
<a href="./index.php" class="btn btn-secondary mb-3">Feedback</a>
</div>
<?php
   
    $sql = "SELECT `Name`, `Email`, `Feedback` FROM `comments`;";
    if($connection != null) {
        try {
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $feedbacks = $statement->fetchAll();
           
            echo '<ul class="list-group">';
            foreach($feedbacks as $feedback) {
                $name = $feedback['Name'] ?? '';
                $email = $feedback['Email'] ?? '';
                $feedback = $feedback['Feedback'] ?? '';
                echo "<li class='list-group-item'>";
                echo "<p>$name</p>";
                echo "<p>$email</p>";
                echo "<p>$feedback</p>";
                echo "</li>";
            }
            echo '</ul>';
        }catch (PDOException $e) {
            echo "Cannot query data. Error: " . $e->getMessage;
        }
    }
  
?>
<?php
  include 'components/footer.php';
?>