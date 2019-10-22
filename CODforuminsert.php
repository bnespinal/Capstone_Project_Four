<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 10/20/2019
 * Time: 11:30 AM
 */
$pagename = "Call Of Duty Forum";
include_once "header.inc.php";
checkLogin();
$showform = 1;
$errmsg = 0;
$errpost = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $formdata['post'] = trim($_POST['post']);
    $game = "Call of Duty";

    if (empty($formdata['post'])) {$errpost = "A post is required."; $errmsg = 1; }

    if($errmsg == 1)
    {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    }
    else{

        try{
            $sql = "INSERT INTO forum (username, game, post, inputdate)
                    VALUES (:username, :game, :post, :inputdate) ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':username', $_SESSION['username']);
            $stmt->bindValue(':game', $game);
            $stmt->bindValue(':post', $formdata['post']);
            $stmt->bindValue(':inputdate', $rightnow);
            $stmt->execute();

            $showform =0; //hide the form
            ?>
            <div class="row">
                <div class="side">
                </div>
                <div class="main">
                    <h1>Post Insert</h1>
                    <?php
                    echo "<p class='success'>Thanks for Posting!</p>";
                    ?>
                </div>
                <div class="side">
                </div>
            </div>
            <?php
        }
        catch (PDOException $e)
        {
            die( $e->getMessage() );
        }
    }
}
if($showform == 1)
{
    ?>
    <div class="row">
        <div class="side"></div>
        <div class="main">
            <h1>Post Insert</h1>
            <form name="CODforuminsert" id="CODforuminsert" method="post" action="CODforuminsert.php">
                <table align='center'>
                    <tr><th><label for="post">Forum Text:</label><span class="error">*</span></th>
                        <td><span class="error"><?php if(isset($errpost)){echo $errpost;}?></span>
                            <textarea name="post" id="post" placeholder="Required post"><?php if(isset($formdata['post'])){echo $formdata['post'];}?></textarea>
                        </td>
                    </tr>
                    <tr><th><label for="submit">Submit:</label></th>
                        <td><input type="submit" name="submit" id="submit" value="submit"/></td>
                    </tr>

                </table>
            </form>
        </div>
        <div class="side"></div>
    </div>
    <?php
}
include_once "footer.inc.php";
?>








