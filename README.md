## Laravel Model Tracker
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


By default, Eloquent automatically manage `created_at` and `updated_at` columns to exist on your tables. In addition to this it also manage a `deleted_at` attribute if the model use "soft delete". However it is very tedious job to manage who create/update the model as well as delete (if soft delete). This also a indication of code repetition.


If you wish to have these automatically managed by Eloquent, `Tracker` is a nice and convenient way to do this.

## Install

You may use Composer to install the package into your Laravel project:

```bash
composer require phpcollective/tracker
```
##### Laravel 5.5+:
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
PhpCollective\Tracker\TrackingServiceProvider::class,
```

## Database: Migrations
To add `created_by` and `updated_by` columns in your table you want to track just use `$table->track()` method in your table migration file. For dropping the columns use `$table->dropTrack()`.
```php
Schema::create('table', function (Blueprint $table) {
    ...
    $table->track();
});

// To drop columns
Schema::table('table', function (Blueprint $table) {
    $table->dropTrack();
});
```

If Your table contains `soft delete` columns, just pass `boolean` `true` in the method. It will add a `deleted_by` column in database.

```php
Schema::create('table', function (Blueprint $table) {
    ...
    $table->softDeletes();
    $table->track(true);
});

// To drop columns with soft delete
Schema::table('table', function (Blueprint $table) {
    $table->dropTrack(true);
});
```

## Model

Add `Trackable` trait in model you want to track. Now it will handle all `CRUD` event by the authenticate user.

```php
<?php

namespace App;

use PhpCollective\Tracker\Trackable;
use Illuminate\Database\Eloquent\Model;

class Foo extends Model
{
    use Trackable;
    
    ...
}
```

## Usage
`Trackable` trait provides three `belongsTo` relationship with Authenticated Users. `creator()`, `editor()`, `destroyer()`

```php
$foo = App\Foo::first();
$foo->creator;
$foo->editor;
// If your model use soft delete
$foo->destroyer;
```

## Credits

- [Al Amin Chayan][link-author]

## License

Laravel Model Tracker is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

[ico-version]: https://img.shields.io/packagist/v/phpcollective/tracker.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/phpcollective/tracker/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/phpcollective/tracker.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/phpcollective/tracker.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpcollective/tracker.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpcollective/tracker
[link-travis]: https://travis-ci.org/phpcollective/tracker
[link-scrutinizer]: https://scrutinizer-ci.com/g/phpcollective/tracker/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/phpcollective/tracker
[link-downloads]: https://packagist.org/packages/phpcollective/tracker
[link-author]: https://github.com/alamin-chayan
