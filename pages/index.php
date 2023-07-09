<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <h1>Index Page</h1>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="list-group">
                <?php
                $pages = scandir( 'pages' );
                foreach ( $pages as $page ) {
                    if ( $page == '.' || $page == '..' ) {
                        continue;
                    }
                    $currentPageName = basename( $_SERVER['REQUEST_URI'], '.php' );
                    $pageName        = basename( $page, '.php' );
                    $pageName        = strtolower( $pageName );
                    $currentPageName = strtolower( $currentPageName );
                    if ( $currentPageName == $pageName || $currentPageName == '' && $pageName == 'index' ) {
                        $active = 'active';
                    } else {
                        $active = '';
                    }

                    $page = str_replace( '.php', '', $page );
                    $page = strtolower( $page );

                    echo "<a href='$page' class='list-group-item list-group-item-action $active'>$pageName</a>";
                }
                ?>
            </div>
        </div>
    </div>
</div>