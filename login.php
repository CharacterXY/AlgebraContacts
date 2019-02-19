<?php

require_once 'core/init.php';

Helper::getHeader('Algebra Contacts', 'main-header');

require_once 'notifications.php';

?>



<?php
  
   if(isset($_POST['name'], $_POST['username'], $_POST['password'], $_POST['confirm_password'])){
      $name = $_POST['name'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      if (!empty($name) && !empty($username) && !empty($password) && !empty($confirm_password)) {
          echo 'OK';
        }
    }

?>






<?php

Helper::getFooter();

?>