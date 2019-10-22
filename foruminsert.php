<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 10/20/2019
 * Time: 2:00 PM
 */
$pagename = "Halo Forum";
include_once "header.inc.php";
checkLogin();
$showform = 1;
$errmsg = 0;
$errpost = "";
$errgame = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $formdata['game'] = trim($_POST['game']);
    $formdata['post'] = trim($_POST['post']);

    if (empty($formdata['game'])) {$errgame = "A game is required."; $errmsg = 1; }
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
            $stmt->bindValue(':game', $formdata['game']);
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
            <form name="foruminsert" id="foruminsert" method="post" action="foruminsert.php">
                <table align='center'>
                    <tr><th><label for="game">Game:</label><span class="error">*</span></th>
                        <td><input name="game" id="game" type="text"  placeholder="Required Game"
                                   value="<?php if(isset($formdata['game'])){echo $formdata['game'];}?>"/>
                            <span class="error"><?php if(isset($errgame)){echo $errgame;}?></span></td>
                    </tr>
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








