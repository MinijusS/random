<?php

namespace Core;

use \App\App;

class Session
{
    /**
     * @var Session variable (either null or user array)
     * that contains session information (email, password)
     */
    private $user;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->loginFromCookie();
    }

    /**
     * Tries to login using stored information
     */
    public function loginFromCookie()
    {
        if (isset($_SESSION['email'])) {
            $this->login($_SESSION['email'], $_SESSION['password']);
        }
    }

    /**
     * Checks if there is a user with given information, if found
     * then creates a session
     * @param $email
     * @param $password
     */
    public function login(string $email, string $password)
    {
        $conditions = [
            'email' => $email,
            'password' => crypt($password, HASH_SALT)
        ];

        if ($this->user = App::$db->getRowWhere('users', $conditions)) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
        }
    }

    /**
     * @return array returns user information
     */
    public function getUser(): ?array
    {
        return $this->user;
    }


    /**
     * Logout user (Destroys session)
     * @param null $redirect
     */
    public function logout($redirect = null)
    {
        $_SESSION = [];
        session_destroy();

        if ($redirect) {
            header("Location: $redirect");
        }
    }
}