<form action="/" method="get">
  <label for="search">Søg</label>
  <input type="text" name="s" id="searchbar" value="<?php the_search_query();?>" required>
  <button type="submit">Søg</button>
</form>
