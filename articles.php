<?php
session_start();
if (empty($_GET)) {
    header('Location:index.php');
    exit(0);
}

$article_name = $_GET["id"];
// $folder = $_COOKIE["src"];
$folder = "article/";
$xml = file_get_contents($folder . $article_name . "/article.xml");
$content = new SimpleXMLElement($xml);
?>

<html>
    <head>
        <link rel="stylesheet" href="/css/banner.css" type="text/css">
        <link rel="stylesheet" href="/css/common.css" type="text/css">
        <link rel="stylesheet" href="/css/articles.css" type="text/css">
        <link rel="stylesheet" href="/css/foot.css" type="text/css">
        <title><?php 
                $textTitre = str_replace(["\$pour", "\$croi","%", "#", "<br>"], ["%", "#", "<", ">", " - "], $content->title);
                echo $textTitre;
         ?></title>
         <link href="https://cdn.lotixam.fr/img/logo.png" rel="icon" type="image/x-icon">
    </head>
    <body>
        <!-- BANNER -->
        <?php include("./header/banner.html");?>
        <div class="bandeau">
            
            <a href="..">blog</a>&nbsp;&#x3E; <?php $textTitre = str_replace(["%", "#", "<br>"], ["<", ">", " - "], $content->title); echo $textTitre ?>
        </div>

        <div class="main-content">
            <?php
            $textTitre = str_replace(["\$pour", "\$croi","%", "#"], ["%", "#", "<", ">"], $content->title);
            echo "<h1>" . $textTitre . "</h1>";
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
            <br>
            <p>
                D'autres articles qui pourraient vous intéresser. Découvrez-les en <u><a href="https://blog.lotixam.fr/">cliquant ici.</a> </u>
            </p>
            <br>
            <p>
                <a href="https://lotixam.fr">Envie d'en savoir plus ? Que vous ayez comme projet de vendre un bien ou d'en acheter un,<br> <u><blue>cliquez-ici</blue></u> pour accéder à notre site complet et découvrir comment Lotixam peut vous aider.</a> 
            </p>
        </div>
    </body>

    <footer>
        <div>
            <a href="https://lotixam.fr">© LOTIXAM SAS 2024. Tous droits réservés</a>
        </div>
        <div class="separator">-</div>
        <div>
            <a href="https://lotixam.fr/html/legals.html">Mentions légales</a>
        </div>
        <div class="separator">-</div>
        <div>
            <a href="https://blog.lotixam.fr/">Blog</a>
        </div>
        <div class="separator">-</div>
        <div>
            <a href="https://faq.lotixam.fr/">FAQ</a>
        </div>
        <div class="separator">-</div>
        <div>
            <a href="https://lotixam.fr/html/contributors.html">Contributeurs &amp; Partenaires</a>
        </div>
        <div class="separator">-</div>
        <div>
            <a href="https://lotixam.fr">Revenir sur lotixam.fr</a>
        </div>
    </footer>

</html>