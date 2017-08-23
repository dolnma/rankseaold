<?php


require_once "dbconfig.php";

$link = conn();

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


//echo "Success: A proper connection to MySQL was made! The my_db qsdfqsdfqsdfqsdfljqsmdfljqsdfdatabase is great." . PHP_EOL;
//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

require('steamauth/steamauth.php');
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="../assets/scss/normalize.css">
    <link rel="stylesheet" href="../assets/scss/home.css">
    <link rel="stylesheet" href="../assets/scss/blog.css">
    <script src="../assets/js/blog.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
<header>
    <nav>
        <div class="navigation">
            <a class="home" href="#">
                <img src="http://ranksea.com/wp-content/themes/ranksea/assets/images/logo.png" alt="Home">
            </a>
            <ul>
                <li><a href="home"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                <li><a href="home?scroll=maps"><i class="fa fa-map" aria-hidden="true"></i>Maps</a></li>
                <li><a href="home?scroll=contact"><i class="fa fa-envelope" aria-hidden="true"></i>Contact</a></li>
                <li id="active"><a href="blog"><i class="fa fa-th-large" aria-hidden="true"></i>Devblog</a></li>
                <li><a href="forum"><i class="fa fa-bookmark" aria-hidden="true"></i>Forums</a></li>


                <?php
                if (!isset($_SESSION['steamid'])) { ?>
                    <li><a href="?login"><i class="fa fa-steam-square" aria-hidden="true"></i>Sign in</a></li>
                    <?php
                }else{
                    ?>
                    <li>
                        <a class="signout" href="../forum?account"><img class="avatar"
                                                                        src="<?php echo $_SESSION['steam_avatarmedium'] ?>"></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
<main>
    <article>
        <h1>Stay up to date with us !</h1>
        <h2>Enjoy the latest news.</h2>

        <div class="blog">

            <?php
            $query = "SELECT id,title,image FROM blog";
            if ($result = $link->query($query)) {
                /* execute statement */
                /* fetch associative array */
                while ($row = mysqli_fetch_assoc($result)) {
                    $items[] = $row;
                }

                $items = array_reverse($items, true);

                foreach ($items as $item) {
                    ?>
                    <div style="background-image: url(<?php echo $item["image"]?>);">
                        <a href="blog/update-<?php echo $item["id"]?>">
                            <h1>Ranksea Update <?php echo $item["id"]?></h1>
                            <h2><?php echo $item["title"]?></h2>
                        </a>
                    </div>
                    <?php
                }
                /* free result set */
                $result->free();
            }
            ?>
        </div>


    </article>


</main>

<footer>
    <section>
        <div>
            <h2>Devblog</h2>
            <a href="#">Community Update 3</a>
            <a href="#">Community Update 2</a>
            <a href="#">Community Update 1</a>
            <a href="#">Developers Update 1</a>
        </div>
        <div>
            <h2>Recent Posts</h2>
            <a href="#">First Opening</a>
            <a href="#">Hello to everyone</a>
            <a href="#">Testing posts</a>
            <a href="#">csgo first tactics vid</a>
        </div>
        <div>
            <h2>Maps</h2>
            <a href="#">Cache</a>
            <a href="#">Dust</a>
            <a href="#">Inferno</a>
            <a href="#">Mirage</a>
        </div>
        <div>
            <h2>Social Media</h2>
            <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i>Facebook</a>
            <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i>Twitter</a>
            <a href="#"><i class="fa fa-steam-square" aria-hidden="true"></i>Steam</a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i>Instagram</a>
        </div>
    </section>
</footer>
</body>
</html>
