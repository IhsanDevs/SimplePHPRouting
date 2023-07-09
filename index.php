<?php

/**
 * Create simple web page using PHP routing.
 * Include all necessary files for pages from
 * directory public. If url trying to access directory
 * public, redirect to default page.
 */

define( 'APP_NAME', 'Ihsan Devs' );
function page()
{
    $folder  = 'pages';
    $default = 'index.php';

    $page = $_SERVER['REQUEST_URI'];

    // if request is root, return default page
    if ( $page == '/' ) {
        return $folder . '/' . $default;
    }

    // remove leading slash from $page
    $page = ltrim( $page, '/' );

    // if request trying to access directory $folder, return errors/404.php
    if ( is_dir( $folder . '/' . $page ) ) {
        return "errors/404.php";
    }

    // if file exists, return $folder/$page.php
    if ( file_exists( $folder . '/' . $page . '.php' ) ) {
        return $folder . '/' . $page . '.php';
    } else {
        return "errors/404.php";
    }
}

function title()
{
    $folder = 'pages';
    $page   = $_SERVER['REQUEST_URI'];

    // if request is root, return default page
    if ( $page == '/' ) {
        return APP_NAME;
    }

    // remove leading slash from $page
    $page = ltrim( $page, '/' );
    $page = strtolower( $page );

    // if request trying to access directory $folder, return errors/404.php
    if ( is_dir( $page ) ) {
        return "404";
    }

    // if file exists, return $folder/$page.php
    $files    = scandir( $folder );
    $newFiles = [];
    foreach ( $files as $file ) {
        if ( $file == '.' || $file == '..' ) {
            continue;
        }

        $file = str_replace( '.php', '', $file );
        $file = strtolower( $file );

        $newFiles[] = $file;
    }

    if ( in_array( $page, $newFiles ) ) {
        if ( $page == 'index' ) {
            return APP_NAME;
        }
        return $page;
    } else {
        return "404";
    }
}

define( 'PAGE', page() );
define( 'TITLE', title() );
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= TITLE ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>

    <?php include( PAGE ) ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</body>

</html>