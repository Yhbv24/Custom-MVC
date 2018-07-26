<?php

class Request
{
    /**
     * Returns whether or not a request is a post request
     * @return boolean
     */
    public static function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }

        return false;
    }

    /**
     * Returns whether or not a request is a get request
     * @return boolean
     */
    public static function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return true;
        }

        return false;
    }
}