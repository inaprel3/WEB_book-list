<?php
    session_start();
    if(!$_SESSION['user']) {
        header('Location: /book-list/auth/login.php');
    }

    function CheckRight($object, $right) {
        require(__DIR__ . '/../data/declare-users.php');
        $found = false;
        foreach($data['users'] as $user) {
            if($user['name'] == $_SESSION['user']) {
                $found = true;
                break;
            }
        }
        if($found) {
            if($object == 'author' && $right == 'view' && substr($user['rights'], 0, 1)) {
                return true;
            }
            if($object == 'author' && $right == 'create' && substr($user['rights'], 1, 1)) {
                return true;
            }
            if($object == 'author' && $right == 'edit' && substr($user['rights'], 2, 1)) {
                return true;
            }
            if($object == 'author' && $right == 'delete' && substr($user['rights'], 3, 1)) {
                return true;
            }

            if($object == 'book' && $right == 'view' && substr($user['rights'], 4, 1)) {
                return true;
            }
            if($object == 'book' && $right == 'create' && substr($user['rights'], 5, 1)) {
                return true;
            }
            if($object == 'book' && $right == 'edit' && substr($user['rights'], 6, 1)) {
                return true;
            }
            if($object == 'book' && $right == 'delete' && substr($user['rights'], 7, 1)) {
                return true;
            }
            if($object == 'user' && $right == 'admin' && substr($user['rights'], 8, 1)) {
                return true;
            }
        }
        return false;
    }
?>