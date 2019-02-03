<?php

    session_start();

    //Flash Message Helper
    //Example: flash('register-success', 'You are now registered', 'alert alert-danger');
    //Display to View: flash('register-success');
    function flash($name = '', $message = '', $class = 'alert alert-success') {
        if(!empty($name)) {
            if(!empty($message) && empty($_SESSION[$name])) {

                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } 
            elseif(empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                
                echo "<div class='$class' id='msg-flash'>" . $_SESSION[$name] . '</div>';
                //Unset Session Variables after Display
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    //Logged In Check
    function isLoggedIn() {
        if(isset($_SESSION['used_id'])) return true;
        else return false;
    }

?>