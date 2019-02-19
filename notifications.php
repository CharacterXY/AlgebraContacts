<?php

    require_once 'core/init.php';

    $sessions = Session::all();

    foreach ($sessions as $key => $msg) {
        switch($key){
            case 'success':
            case 'danger':
            case 'info':
            case 'warning':

            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-<?php echo $key; ?> alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $msg; ?>
                    </div>
                </div>
            </div>

            <?php
            Session::delete($key);
            break;
            default:
        }
    }

?>