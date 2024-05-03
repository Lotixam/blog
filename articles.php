<?php
session_start();

$article_name = $_GET["id"];
$folder = $_COOKIE["src"];
$xml = file_get_contents($folder . $article_name . "/article.xml");
$content = new SimpleXMLElement($xml);
?>

<html>
    <head>
        <link rel="stylesheet" href="../css/banner.css" type="text/css">
        <link rel="stylesheet" href="../css/common.css" type="text/css">
        <link rel="stylesheet" href="../css/articles.css" type="text/css">
    </head>
    <body>
        <!-- BANNER -->
        <?php include("./header/banner.html");?>
        <div class="bandeau">
            <a href="..">blog</a>&nbsp;&#x3E; <?php  echo $content->title ?>
        </div>

        <div class="main-content">
            <?php
            echo "<h1>" . $content->title . "</h1>";
            echo "<div class='sub-content'>";
            $textIntro = str_replace(["\$pour", "\$croi","%", "#"], ["%", "#", "<", ">"], $content->content->p[0]->text);
            echo "<p>" . $textIntro . "</p>";
            echo "<img src=\"" . $folder . $article_name .'/' . $content->image->url . "\" alt='image for '" . $article_name . "\">";

            $i = 0;
            foreach($content->content->p as $paragraphe) {
                if($i > 0) {
                    echo "<h2> $paragraphe->title </h2>";
                    // $text = str_replace(["%ul#", "%ol#", "%li#", "%br#"], ["<ul>", "<ol>", "<li>", "<br>"], $paragraphe->text);
                    // $text = str_replace(["%/ul#", "%/ul#", "%/li#"], ["</ul>", "</ol>", "</li>"], $text);
                    $text = str_replace(["\$pour", "\$croi","%", "#"], ["%", "#", "<", ">"], $paragraphe->text);
                    echo "<p> $text </p>";
                    if($paragraphe->image->url != '') {
                        echo "<img src='" . $folder . $article_name .'/' . $paragraphe->image->url . "' alt='img for $article_name'>";
                    }
                }
                ++$i;
            }
            echo "</div>"
            ?>
            <div class="contact" id="contact-welcome">
                <button class="contact-button" id="contact-button-index-1"
                    onclick="window.location.href = 'https://lotixam.fr';">LOTIXAM SITE</button>
            </div>
        </div>
    </body>
</html>