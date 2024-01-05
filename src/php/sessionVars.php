<?php
    session_start();

    $usermail = isset($_SESSION["mail"])
        ? $_SESSION["mail"]
        : "Anonymous";