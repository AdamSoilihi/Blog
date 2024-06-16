<?php

if (!isset($_SESSION['loggedUser'])) {
    echo('Il faut être authentifié pour cette action.');
    exit;
}
?>