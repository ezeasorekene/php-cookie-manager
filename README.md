# PHP Cookie Manager

This class provides methods to manage cookies in PHP applications.

This PHP class provides convenient methods to manage cookies in web applications.

## Installation

You can install this package using Composer:

```bash
composer require ezeasorekene/php-cookie-manager

## Usage

```php

// Get the value of a cookie
$username = Cookie::get('username');

// Set a cookie with custom options
Cookie::set('user_id', 123, ['expires' => time() + 3600, 'secure' => true]);

// Check if a cookie exists
if (Cookie::has('token')) {
    // Perform an action
}

// Destroy a cookie
Cookie::destroy('session_id');

```

## Methods

```php

get($name)
Get the value of a cookie.

set($name, $value, $options = [])
Set a cookie.

setMultiple($cookies, $options = [])
Set multiple cookies.

has($name)
Check if a cookie exists.

destroy($name, $options = [])
Destroy a cookie.

destroyMultiple($cookies, $options = [])
Destroy multiple cookies.

jsonSet($name, $value, $options = [])
Set a JSON-encoded cookie.

jsonGet($name, $assoc = false)
Get the JSON-decoded value of a cookie.

jsonHas($name)
Check if a JSON-encoded cookie exists.

jsonDestroy($name, $options = [])
Destroy a JSON-encoded cookie.

jsonDestroyMultiple($cookies, $options = [])
Destroy multiple JSON-encoded cookies.

```

## Contributing

If you'd like to contribute, please fork the repository and make your changes. Pull requests are warmly welcome.

## License

This package is licensed under the MIT License.

## Author

[Ezeasor Ekene](https://github.com/ezeasorekene)

## Contact

For inquiries, please email me at <ezeasorekene@gmail.com>

## Copyright

© 2023 Ezeasor Ekene. All rights reserved.
