<?php wp_footer();?>
<footer>
  <?php
  if( is_active_sidebar('min-sidebar') ) : dynamic_sidebar('min-sidebar');
  endif;
  ?>
</footer>
</body>
</html>
