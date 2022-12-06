<form action="/faaborgmuseum/" method="get" class="searchbar">
  <label for="search" id="searchlabel">Søg</label>
  <input type="text" name="s" id="searchbar" value="<?php the_search_query();?>" required>
  <button type="submit" id="searchbutton">Søg</button>
</form>
