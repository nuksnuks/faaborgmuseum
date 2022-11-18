<?php

$bottomtext = get_option('footers_array');


?><footer>
    <div class="container">
        <div class="row"   style="padding-bottom: 25px;">
            <div class="col-xs-12 col-sm-6 col-md-3">

                <img class="img-responsive" style="max-width: 250px; margin: 0" src="<?php echo get_stylesheet_directory_uri(); ?>/images/faaborg_logo_m_tekst.svg" alt="" title="" />

                <p><?php echo nl2br( __('SEO Beskrivelse','FaaborgMuseum'),true); ?></p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">

				
               <ul class="navlist">
                    <li><?php echo __('Priser','FaaborgMuseum'); ?></li>
                    <li><?php echo nl2br(__('Priser tekst','FaaborgMuseum'),true); ?></li>
                </ul>

                <div style="margin-top: 10px;" class="whiteoutlinebox"><?php echo __('I dag','FaaborgMuseum'); ?> <?php echo date('j/n',time()); ?>:  <?php echo getOpenHours(get_option('opening_hours_array')) ?></div>

            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">

                <ul class="navlist">
                    <li><?php echo __('Find vej','FaaborgMuseum'); ?></li>
					<li style="text-align: center;">
						<a href="https://www.google.dk/maps/place/Faaborg+Museum+%E2%80%93+En+forunderlig+verden+af+kunst/@55.0942691,10.2463511,17z/data=!4m5!3m4!1s0x464cd5721372f4d9:0xc2bbb623132dd1d0!8m2!3d55.094573!4d10.247432"> <img style="height: 200px; width: auto;" src=" https://www.faaborgmuseum.dk/wp-content/uploads/2021/03/Faaborg-Museum-Kort-1.jpg" alt="find vej"
						> </a>
					</li>
                </ul>

            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">

                <ul class="navlist">
                    <li><?php echo __('Kontakt','FaaborgMuseum'); ?></li>
                    <li>
                        Faaborg Museum<br />
                        Grønnegade 75<br />
                        5600 Faaborg<br />
                        Tlf. <?php

                            if (get_post_meta( get_the_id() , '_locale', true ) !== "da_DK") {
                                echo "+45";
                            }

                        echo $currentlang;  ?> 62 61 06 45<br />
                        <a style="color: white" href="mailto: info@faaborgmuseum.dk">info@faaborgmuseum.dk</a>
                    </li>
                    <li style="margin-top: 20px; text-align: center">
                        <div class="socialicons">
                            <a href="https://instagram.com/explore/tags/faaborgmuseum/" target="_blank"><span class="icon-instagram"></span></a>
                            <a href="https://www.facebook.com/Faaborg-Museum-for-fynsk-malerkunst-122730301073741/?ref=hl" target="_blank"><span class="icon-facebook"></span></a>
                            <a href="mailto: info@faaborgmuseum.dk"><span class="icon-email"></span></a>
                        </div>
                    </li>
                </ul>

            </div>

        </div>

    </div>

</footer>

<?php

    wp_footer();

?>  
   </body>
</html>