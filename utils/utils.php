<?php


class utils
{
    public static function IsConnected(): bool
    {
        return array_key_exists("user_id", $_SESSION) && $_SESSION["user_id"] == true;
    }
}
