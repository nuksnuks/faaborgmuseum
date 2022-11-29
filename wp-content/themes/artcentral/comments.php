<?php /*

@package artcentral

*/

if(post_password_required() ){
  return;
}

?>

<div id="comment" class="comment-area">
  <?php comment_form();?>
</div>
