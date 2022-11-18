<?php

?>

<header class="navigation">
    <nav class="navbar navbar-default navbar-trans at-top">

        <div class="container">

            <div class="row">

                <div class="col-xs-10">
                    <button class="navclose collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="icon-icon_menu_black"></span>
                        <div class="navbutton hidden-xs"><?php echo __('MENU','FaaborgMuseum'); ?></div>
                    </button>

                    <?php

                        $currentlang = get_post_meta( get_the_id() , '_locale', true );


                        $calendarID     = get_page_by_title( 'Kalender' )->ID;
                        $calendarLink   = get_permalink($calendarID);

                        if ( function_exists( 'bogo_get_post_translations' ) ) {
                            $translations = bogo_get_post_translations($calendarID);

                            if ( ! empty( $translations[$currentlang] ) ) {
                                $calendarLink = get_permalink( $translations[$currentlang] );
                            }
                        }

                        $frontpageID = get_option('page_on_front');
                        $frontpageLink   = get_permalink($frontpageID);

                        if ( function_exists( 'bogo_get_post_translations' ) ) {
                            $translations = bogo_get_post_translations($frontpageID);

                            if ( ! empty( $translations[$currentlang] ) ) {
                                $frontpageLink = get_permalink( $translations[$currentlang] );
                            }
                        }
					
                    ?>

                    <a style="padding-left: 33px" href="<?php echo $calendarLink; ?>">
                    <a style="padding-left: 33px" href="https://www.faaborgmuseum.dk/kalender/">
                        <button class="c-button hidden-xs">
                          <div class="icon-icon_calendar_black"></div>
                          <div class="navbutton"><?php echo __('KALENDER','FaaborgMuseum'); ?></div>
                        </button>
                    </a>

                </div><!--
                --><div class="col-xs-2 logocontainer">
                    <a href="<?php echo $frontpageLink; ?>">
                        <div id="logo"></div>
                    </a>
                </div>

            </div>

            <div id="navbar" class="navbar-collapse collapse" aria-expanded="false">

            <?php
                output_faaborg_menu();
            ?>

            </div>
        </div>
    </nav>
</header>
