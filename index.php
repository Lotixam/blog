<?php

session_start();
// $srcArticles = "../apps/articles/";
$srcArticles = "article/";
setcookie("src",  $srcArticles, time() + (3600)); // set cookie for src of articles folder

exec('cd ' . $srcArticles . '. && ls -1t', $output, $return_var);
// echo "<pre>"; print_r($output); echo "</pre>"; // Affiche le résultat sous forme de tableau

// $xmlListString = file_get_contents($srcArticles . 'list.xml');
// $list = new SimpleXMLElement($xmlListString);
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="/css/banner.css" type="text/css">
        <link rel="stylesheet" href="/css/common.css" type="text/css">
        <link rel="stylesheet" href="/css/preview_articles.css" type="text/css">
        <link rel="stylesheet" href="/css/foot.css" type="text/css">
    </head>
    <body>
        <!-- BANNER -->
        <?php include("./header/banner.html"); ?>

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
                $textTitre = str_replace(["\$pour", "\$croi","%", "#"], ["%", "#", "<", ">"], $article->title);
                $textTitre = mb_strtoupper($textTitre);
                echo "<h3>" . $textTitre . "</h3>";
                // echo "<p>" . $article->content->p[0]->text . "</p>";
                echo "Lire la suite...</a>";
                echo "</div>";
                ++$i;
            }
            echo "</div>\n";
            ?>
        </div>
        
    </body>
    <footer>
        <div>
            <a href="https://lotixam.fr">© LOTIXAM SAS 2024. Tous droits réservés</a>
        </div>
        <div class="separator">-</div>
        <div>
            <a href="legals.html">Mentions légales</a>
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
            <a href="contributors.html">Contributeurs &amp; Partenaires</a>
        </div>
        <div class="separator">-</div>
        <div>
            <a href="https://lotixam.fr">Revenir sur lotixam.fr</a>
        </div>
    </footer>
</html>