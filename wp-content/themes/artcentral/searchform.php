<form action="/" method="get" class="searchbar">
  <div id="searchbar-container">
  <label for="search" id="searchlabel">Søg</label>

  <input type="text" name="s" id="searchbar" value="<?php the_search_query();?>" required style="display:none;">
  <button type="submit" id="searchbutton"style="display:none;">Søg</button>
  </div>
</form>
