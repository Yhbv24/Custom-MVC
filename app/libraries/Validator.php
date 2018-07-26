<?php

class Validator
{
    /**
     * Takes $_POST data and sanitizes it
     * @param array $params $_POST array
     * @return array
     */
    public static function filterPostForm(array $params)
    {
        $params = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        foreach ($params as $param) {
            $param = trim($param);
        }

        return $params;
    }

    /**
     * Make sure no fields are left empty
     * @param array $params
     * @return bool
     */
    public static function notEmpty(array $params)
    {
        foreach ($params as $param) {
            if (empty($param)) {
                return false;
            }
        }

        return true;
    }
}