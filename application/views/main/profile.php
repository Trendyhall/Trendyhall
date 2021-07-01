profile <br>
<button type="button" class="btn btn-outline-dark" onclick="setCookie('user-id', 0, {'max-age': 0}); window.location.replace('/');">Выйти</button><br>
<?php 
echo 'UserID: '.$this->data['UserID'];