<?php

class Session
{
    /**
     * Set a session variable
     * @param string $param
     * @return void
     */
    public static function set(string $name, string $param)
    {
        $_SESSION[$name] = $param;
    }

    /**
     * Returns Session variable
     * @param string $param
     * @return mixed
     */
    public static function get(string $param)
    {
        if (isset($_SESSION[$param])) {
            return $_SESSION[$param];
        }
    }

    /**
     * Returns all Session variables
     * @return array
     */
    public static function all()
    {
        return $_SESSION;
    }
}