
<div class="list-group">
  <a href="/special/database-upload" class="list-group-item list-group-item-action">Database upload</a>
  <a href="/special/headers" class="list-group-item list-group-item-action">See headers</a>
  <a href="/special/databasedebug" class="list-group-item list-group-item-action">Database debug</a>
  <a href="/special/fillucode" class="list-group-item list-group-item-action">Fill ucode</a>
  <a  class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
</div>

<?php 
echo 'UserID: '.$this->data['UserID'];
echo '<br>';
echo 'if: '. ($this->data['UserID'] == '0');
 ?>