<?php

abstract class Utilities
{
    public static function showArray($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    public static function alertMessage($message, $type)
    {
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type
        ];
    }
}
