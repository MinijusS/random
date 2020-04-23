<?php

/**
 * Returns current user
 * @return bool|mixed or false (if is not logged in)
 */
function current_user()
{
    if (isset($_SESSION['email'])) {
        $conditions = [
            'email' => $_SESSION['email'],
            'password' => crypt($_SESSION['password'], HASH_SALT)
        ];

        if ($users = App\App::$db->getRowsWhere('users', $conditions)) {
            return reset($users);
        } else {
            return false;
        }
    }
}