<?php

/**
 * PHP Cookie Manager Class
 *
 * This class provides methods to manage cookies in PHP applications.
 *
 * @category   Utilities
 * @package    ezeasorekene/php-cookie-manager
 * @author     Ekene Ezeasor
 * @copyright  Copyright (c) 2023, Ekene Ezeasor
 * @license    MIT
 * @version    2.1.0
 * @link       https://github.com/ezeasorekene/php-cookie-manager
 * @contact    ezeasorekene@gmail.com
 * 
 * @example    Usage Examples:
 *
 * // Get the value of a cookie
 * $username = Cookie::get('username');
 *
 * // Set a cookie with custom options
 * Cookie::set('user_id', 123, ['expires' => time() + 3600, 'secure' => true]);
 *
 * // Check if a cookie exists
 * if (Cookie::has('token')) {
 *     // Perform an action
 * }
 *
 * // Destroy a cookie
 * Cookie::destroy('session_id');
 */


namespace ezeasorekene\PhpCookieManager;


class Cookie
{
    // Default cookie options
    private static $defaultOptions = [
        'expires' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => false,
        'samesite' => 'Lax'
    ];

    /**
     * Get the value of a cookie.
     *
     * @param string $name Name of the cookie.
     * @return mixed|null Value of the cookie if it exists, null otherwise.
     */
    public static function get($name)
    {
        return $_COOKIE[$name] ?? null;
    }

    /**
     * Set a cookie.
     *
     * @param string $name Name of the cookie.
     * @param mixed $value Value of the cookie.
     * @param array $options Options for the cookie (optional).
     * @return bool True on success, false on failure.
     */
    public static function set($name, $value, $options = [])
    {
        $options = array_merge(self::$defaultOptions, $options);

        if (is_array($value)) {
            $value = json_encode($value);
        }

        return setcookie($name, $value, $options);
    }

    /**
     * Set multiple cookies at once.
     *
     * @param array $cookies Associative array of cookie names and values.
     * @param array $options Options for the cookies (optional).
     * @return void
     */
    public static function setMultiple($cookies, $options = [])
    {
        foreach ($cookies as $name => $value) {
            self::set($name, $value, $options);
        }
    }

    /**
     * Check if a cookie exists.
     *
     * @param string $name Name of the cookie.
     * @return bool True if the cookie exists, false otherwise.
     */
    public static function has($name)
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * Destroy a cookie.
     *
     * @param string $name Name of the cookie.
     * @param array $options Options for the cookie (optional).
     * @return bool True on success, false on failure.
     */
    public static function destroy($name, $options = [])
    {
        $options = array_merge(self::$defaultOptions, $options);
        if (self::has($name)) {
            $expiry_option = [
                'expires' => time() - 3600,
            ];
            $options = array_merge($options, $expiry_option);
            return setcookie($name, '', $options);
        }
        return false;
    }

    /**
     * Destroy multiple cookies at once.
     *
     * @param array $names Array of cookie names to destroy.
     * @param array $options Options for the cookies (optional).
     * @return void
     */
    public static function destroyMultiple($cookies, $options = [])
    {
        foreach ($cookies as $name) {
            self::destroy($name, $options);
        }
    }

    /**
     * Set a JSON-encoded cookie.
     *
     * @param string $name Name of the cookie.
     * @param mixed $value Value of the cookie.
     * @param array $options Options for the cookie (optional).
     * @return bool True on success, false on failure.
     */
    public static function jsonSet($name, $value, $options = [])
    {
        $options = array_merge(self::$defaultOptions, $options);

        if (is_array($value)) {
            $value = json_encode($value);
        }

        return setcookie($name, $value, $options);
    }

    /**
     * Get the JSON-decoded value of a cookie.
     *
     * @param string $name Name of the cookie.
     * @param bool $assoc When true, return array as associative; when false, return as object.
     * @return mixed|null Value of the cookie if it exists, null otherwise.
     */
    public static function jsonGet($name, $assoc = false)
    {
        $value = $_COOKIE[$name] ?? null;
        return ($value !== null) ? json_decode($value, $assoc) : null;
    }

    /**
     * Check if a JSON-encoded cookie exists.
     *
     * @param string $name Name of the cookie.
     * @return bool True if the cookie exists, false otherwise.
     */
    public static function jsonHas($name)
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * Destroy a JSON-encoded cookie.
     *
     * @param string $name Name of the cookie.
     * @param array $options Options for the cookie (optional).
     * @return bool True on success, false on failure.
     */
    public static function jsonDestroy($name, $options = [])
    {
        return self::destroy($name, $options);
    }

    /**
     * Destroy multiple JSON-encoded cookies at once.
     *
     * @param array $names Array of cookie names to destroy.
     * @param array $options Options for the cookies (optional).
     * @return void
     */
    public static function jsonDestroyMultiple($cookies, $options = [])
    {
        return self::destroyMultiple($cookies, $options);
    }

    /**
     * Set default options for cookies.
     *
     * @param array $options Array of default options to set.
     * @return void
     */
    public static function setDefaultOptions($options)
    {
        self::$defaultOptions = array_merge(self::$defaultOptions, $options);
    }

}