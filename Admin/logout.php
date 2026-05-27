<?php

require('Inc/essentials.php');

session_start();

/* =========================
   UNSET ALL SESSION DATA
========================= */

$_SESSION = array();

/* =========================
   DESTROY SESSION
========================= */

session_destroy();

/* =========================
   REDIRECT TO LOGIN
========================= */

redirect('index.php');
