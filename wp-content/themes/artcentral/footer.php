<?php wp_footer();?>
<div id="footer">
<footer>
  <?php
  if( is_active_sidebar('min-sidebar') ) : dynamic_sidebar('min-sidebar');
  endif;
  ?>
</footer>
</div>
</body>
</html>
