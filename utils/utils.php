<?php


class utils
{
    public static function IsConnected(): bool
    {
        return $_SESSION["user_id"] == true;
    }
}
