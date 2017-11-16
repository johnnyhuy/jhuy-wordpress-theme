# jHuy WordPress Theme

This is my first WordPress theme created for my personal website at [johnnyhuy.com](http://johnnyhuy.com).

## Todo

- Release build (.zip) for normal upload installation. This build will have prebuilt assets.

## Getting Started

### Prerequisites

- NodeJS LTS or v 8.9.0+
- WordPress
- Directory access to WordPress content (e.g. FTP)

### Installing

***1. Get this theme***

Download this theme from this repository from the root directory and place in your WordPress `wp-content/themes` folder.

***2. Build assets with Node npm scripts***

Since this project relies on npm packages, packages need to be install and assets need to be compiled. Run the following commands in sequential order.

Change directory to root of jHuy theme where `package.json` exists.

Install Node packages.

```
$ npm i
```

Build assets for development/production


**(Recommended)** Development: build with server
This is required to have hot-swapping and live reloading for development use. It uses the webpack dev server with a proxy to a main host (e.g. WAMP or LAMP setup).

```
$ npm run dev
```

Development: build without server

```
$ npm run dev-no-server
```

Production

```
$ npm run prod
```

***3. Select theme***

Go to your WordPress and select the theme `jHuy`.

## Development

This project uses the Node package manager to build assets such as Sass. I've also included a VSCode setting to enable php-cs a Code-Sniffer to follow the WordPress standard to further add consistancy in code.

This is an open source project so please feel free to add changes.

## Testing

I have added [Codeception](http://codeception.com) as the testing framework of choice for this project. The following instructions will demonstrate running and writing tests in regard to the theme. For any further documentation visit these links:

- [Codeception WordPress Quick Start](http://codeception.com/for/wordpress)
- [Codeception Documentation Introduction](http://codeception.com/docs/01-Introduction)

***Prerequisites***

These are the requirements that have been tested. Composer packages can be install with `composer install` at the root theme directory.

- MySQL 14.14+ (running instance with access to database)
- PHP 7.1+
- [Codeception](http://codeception.com)
- [WPBrowser](http://codeception.com/for/wordpress)

***1. Initialize WPBrowser***

Run `vendor/bin/codecept init wpbrowser` to create a template generated by WPBrowser. Some notes worth knowing before running the command:

- When prompt for the location of WordPress installation, use full path directory (e.g. /Users/johnny/wordpress not ~/wordpress)
- Once template is created, check if the test database is set to the proper test database name
- Create a `dump.sql` file at `tests/_data` directory (can be empty)

***2. Run Tests***

Running tests can be done with the following commmand:

```
$ vendor/bin/codecept run
```

Running specific tests suites (exclude square brackets and use a single option e.g. `codecept run wpunit`):

```
$ vendor/bin/codecept run [unit|wpunit|functional|acceptance]
```

***Writing Tests***

These instructions assume test suites are unit, wpunit, functional, acceptance. Use the following commands to generate test cases in regard to their test suites:

Create a WordPress unit test:

```
$ vendor/bin/codecept g:wpunit wpunit ExampleTest
```

Create a scenario test (exclude square brackets and use a single option e.g. `codecept g:cest acceptance ExampleTest`):

```
$ vendor/bin/codecept g:cest [functional|acceptance] ExampleTest
```

## License

This project is licensed under the MIT License - see the LICENSE file for details
