<?php
if (!function_exists('env')) {
    /**
     * Fetch an environment variable with an optional default.
     */
    function env(string $key, $default = null) {
        $value = getenv($key);
        if ($value === false || $value === '') {
            return $default;
        }
        return $value;
    }
}

if (!function_exists('appBaseUrl')) {
    /**
     * Resolve the application base URL used to build absolute links in emails.
     */
    function appBaseUrl(): string
    {
        $fromEnv = env('APP_BASE_URL');
        if ($fromEnv) {
            return rtrim($fromEnv, '/');
        }

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';

        return $scheme . '://' . $host;
    }
}
