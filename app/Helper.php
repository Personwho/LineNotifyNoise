<?php

if (!function_exists('env')) {
    /**
     * 讀取$_ENV設定, 如果沒有則讀取$default值.
     *
     * @param string $name    環境變數名稱
     * @param string $default 預設值, 找不到時回傳
     */
    function env(string $name, string $default = null)
    {
        if (!isset($_ENV[$name])) {
            return $default;
        }

        return !$_ENV[$name] && '0' !== $_ENV[$name] ? $default : $_ENV[$name];
    }
}
