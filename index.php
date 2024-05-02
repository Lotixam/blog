<?php

session_start();
include("./header/banner.html");
exec('cd .. && ls', $output, $return_var);
echo "<pre>"; print_r($output); echo "</pre>"; // Affiche le résultat sous forme de tableau