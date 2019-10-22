<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 10/20/2019
 * Time: 5:00 PM
 */
?>
<ul id="nav">
    <?php
    if(isset($_COOKIE)) {
        echo ($currentfile == "index.php") ? "<li>Home</li>" : "<li><a href='index.php'>Home</a></li>";
        echo ($currentfile == "memberinsert.php") ? "<li>Register</li>" : "<li><a href='memberinsert.php'>Register</a></li>";
        echo ($currentfile == "Haloforumprint.php") ? "<li>Halo</li>" : "<li><a href='Haloforumprint.php'>Halo</a></li>";
        echo ($currentfile == "CODforumprint.php") ? "<li>Call Of Duty</li>" : "<li><a href='CODforumprint.php'>Call Of Duty</a></li>";
        echo ($currentfile == "SWTORforumprint.php") ? "<li>Star Wars The Old Republic</li>" : "<li><a href='SWTORforumprint.php'>Star Wars The Old Republic</a></li>";
        echo ($currentfile == "forumprint.php") ? "<li>Other Posts</li>" : "<li><a href='forumprint.php'>Other Posts</a></li>";
        if (isset($_SESSION['ID'])) {
            echo ($currentfile == "membermanage.php") ? "<li>Meet Your Peers</li>" : "<li><a href='membermanage.php'>Meet Your Peers</a></li>";
            echo ($currentfile == "searchuser.php") ? "<li>Search Users</li>" : "<li><a href='searchuser.php'>Search Users</a></li>";
            echo ($currentfile == "searchforum.php") ? "<li>Search Forums</li>" : "<li><a href='searchforum.php'>Search Forums</a></li>";
            echo "<li><a href='logout.php'>Log Out</a></li>";
            echo "Welcome back, " . $_SESSION['username'];
        } else {
            echo "<li><a href='login.php'>Log In</a></li>";
        }
    }
    ?>
</ul>

