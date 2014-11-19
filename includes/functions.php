<?php
function validar_email($email){
    $exp = "^[a-z'0-9]+([._-][a-z'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";

    if (preg_match( '/'.$exp.'/i', $email)) {
        if(checkdnsrr(array_pop(explode("@",$email)), 'MX')) {
            return true;
        }
        else {
            return false;
        }
    }
    else {

        return false;
    }
}
?>