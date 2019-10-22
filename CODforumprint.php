<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 10/19/2019
 * Time: 6:00 PM
 */
$pagename = "Forum Stream";
require_once "header.inc.php";
?>
    <div class="row">
        <div class="side">
        </div>

        <div class="main">
            <h1>Call of Duty Forum</h1>
            <div><img src="images/CODimage.jpg" width="720" alt="Welcome_sign" class="centerImg"></div><br>
            <?php
            if(isset($_SESSION['ID']))
            {
                echo "<p id=\"statement\"><a href='CODforuminsert.php'>Write a Post</a></p>";
            }
            try{
                $sql = "SELECT * FROM forum WHERE game = 'Call Of Duty' ORDER BY inputdate DESC";
                $result = $pdo->query($sql);


                echo "<table align='center'>";

                foreach ($result as $row){
                    echo "<tr><td>". $row['username']. "</td><td>";
                    echo $row['post'];
                    echo "</td><td>";
                    echo date("l, F j, Y", $row['inputdate']);
                    echo "</td></tr>\n";
                }
                echo "</table>";
            }
            catch (PDOException $e) {
                die($e->getMessage());
            }
            ?>
        </div>
        <div class="side">
        </div>
    </div>
<?php
require_once "footer.inc.php";









