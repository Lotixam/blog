<?php

session_start();
// $srcArticles = "../apps/articles/";
$srcArticles = "article/";
setcookie("src",  $srcArticles, time() + (3600)); // set cookie for src of articles folder

exec('cd ' . $srcArticles . '. && ls', $output, $return_var);
// echo "<pre>"; print_r($output); echo "</pre>"; // Affiche le résultat sous forme de tableau

// $xmlListString = file_get_contents($srcArticles . 'list.xml');
// $list = new SimpleXMLElement($xmlListString);
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="../css/banner.css" type="text/css">
        <link rel="stylesheet" href="../css/common.css" type="text/css">
        <link rel="stylesheet" href="../css/preview_articles.css" type="text/css">
    </head>
    <body>
        <!-- BANNER -->
        <?php include("./header/banner.html"); ?>

        <!-- TITRE -->
        <h1 style="text-align: center">BLOG</h1>
        <!-- CONTENU -->
        <div class="articles">
            <?php

            $i = 0;
            echo "<div class='group-article'>";

            // Les output vont être les dossiers des articles en XML
            // Chaque article (dossiers) a un XML et une Image, c'est tout
            foreach ($output as $value) {
                if($i % 3 == 0){
                    echo "</div><div class='group-article'>";
                }

                $dossier = $srcArticles . $value;

                $xmlString = file_get_contents($dossier . '/article.xml');
                $article = new SimpleXMLElement($xmlString);

                echo "<div class='single-article'>";
                echo "<a href=\"./articles.php?id="  . $value . "\" >";
                echo "<img src=\"" . $dossier . "/". $article->image->url .  "\"><br/>";
                echo "<h3>" . $article->title . "</h3>";
                // echo "<p>" . $article->content->p[0]->text . "</p>";
                echo "Lire la suite...</a>";
                echo "</div>";
                ++$i;
            }
            echo "</div>\n";
            ?>
        </div>
    </body>
</html>