<?php

require_once "../dbconfig.php";

$link = conn();

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

//echo "Success: A proper connection to MySQL was made! The my_db qsdfqsdfqsdfqsdfljqsmdfljqsdfdatabase is great." . PHP_EOL;
//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

//mysqli_close($link);

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="/assets/scss/normalize.css">
    <link rel="stylesheet" href="/assets/scss/home.css">
    <link rel="stylesheet" href="/assets/scss/map.css">
    <link rel="stylesheet" href="/assets/scss/style.css">
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
            <ul>
                <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                <li><a href="../?scroll=maps"><i class="fa fa-map" aria-hidden="true"></i>Maps</a></li>
                <li><a href="../?scroll=contact"><i class="fa fa-envelope" aria-hidden="true"></i>Contact</a></li>
                <li id="active"><a href="../blog"><i class="fa fa-th-large" aria-hidden="true"></i>Devblog</a></li>
                <li><a href="../forum.php"><i class="fa fa-bookmark" aria-hidden="true"></i>Forums</a></li>
            </ul>
        </div>
    </nav>
</header>
<main>
<article>
    <h1>test</h1>
    <div class="maps">
        <img class="active" id="1" src="/assets/backgrounds/de_cache.png">
        <img id="2" src="/assets/backgrounds/de_cbble.png">
        <img id="3" src="/assets/backgrounds/de_dust2.png">
        <img id="4" src="/assets/backgrounds/de_nuke.png">
        <img id="5" src="/assets/backgrounds/de_inferno.png">
        <img id="6" src="/assets/backgrounds/de_overpass.png">
        <img id="7" src="/assets/backgrounds/de_mirage.png">
    </div>
    <section>
        <div class="controls">
            <button id="smoke">smoke</button>
            <button id="flash">fire</button>
            <button id="fire">test</button>
            <button id="side">test</button>
            <button id="calls">test</button>
        </div>
        <div id="i">
            <svg id = "map" viewBox="0 0 1123 850" style="cursor:default">
                <image style="pointer-events:none" height="1024" width="1024" y="0" x="0" class="img-responsive" preserveAspectRatio="none" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/assets/backgrounds/de_cachemap.png"></image>
                <?php

                $query = "SELECT n.id, n.title, n.side, n.line_x1, n.line_y1, n.line_x2, n.line_y2, n.middle_positions, no.name AS name, no.value AS value FROM nades n JOIN nades_options no ON no.id = n.mode";
                if ($stmt = $link->prepare($query)){
                    /* execute statement */
                    $stmt->execute();

                    /* bind result variables */
                    $stmt->bind_result($id, $title,$side,$line_x1,$line_y1,$line_x2,$line_y2,$middle_positions,$name,$value);

                    /* fetch values */
                    while ($stmt->fetch()) {
                        // printf ("%s (%s)\n", $id, $title,$side,$line_x1,$line_y1,$line_x2,$line_y2,$middle_positions,$name,$value);
                        $translate_x = $line_x2-20;
                        $translate_y = $line_y2-29;


                        if($side == 1){
                            ?>
                            <g id="g<?php echo $id; ?>" name="<?php echo $name; ?>" class="grenade" style="opacity:1; pointer-events:all">
                                <a data-toggle="modal" data-target="#view-modal" data-id="<?php echo $id; ?>" id="getId" class="grenadeLink">
                                    <circle cx="<?php echo $line_x1; ?>" cy="<?php echo $line_y1; ?>" r="5" class="line_dot"></circle>
                                    <polyline points="<?php echo $line_x1 ?>,<?php echo $line_y1 ?> <?php echo $middle_positions ?> <?php echo $line_x2 ?>,<?php echo $line_y2 ?>" class="line_dot" style="fill:none;"></polyline>

                                    <g transform="translate(<?php echo $translate_x; ?>,<?php echo $translate_y; ?>) scale(.1)">
                                        <path d="<?php echo $value; ?>" class="nade_t"></path>

                                    </g>
                                </a>
                            </g>
                            <?php
                        }else{
                            ?>
                            <g id="g<?php echo $id; ?>" name="<?php echo $name; ?>" class="grenade" style="opacity:1; pointer-events:all">
                                <a data-toggle="modal" data-target="#view-modal" data-id="<?php echo $id; ?>" id="getId" class="grenadeLink">
                                    <circle cx="<?php echo $line_x1; ?>" cy="<?php echo $line_y1; ?>" r="5" class="line_dot2"></circle>
                                    <polyline points="<?php echo $line_x1 ?>,<?php echo $line_y1 ?> <?php echo $middle_positions ?> <?php echo $line_x2 ?>,<?php echo $line_y2 ?>" class="line_dot2" style="fill:none;"></polyline>

                                    <g transform="translate(<?php echo $translate_x; ?>,<?php echo $translate_y; ?>) scale(.1)">
                                        <path d="<?php echo $value; ?>" class="nade_ct"></path>

                                    </g>
                                </a>
                            </g>
                            <?php
                        }
                    }

                    /* close statement */
                    $stmt->close();
                };

                mysqli_close($link);
                ?>


            </svg>
        </div>
    </section>

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
