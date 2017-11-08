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
npm i
```

Build assets for development/production


**(Recommended)** Development: build with server
This is required to have hot-swapping and live reloading for development use. It uses the webpack dev server with a proxy to a main host (e.g. WAMP or LAMP setup).

```
npm run dev
```

Development: build without server

```
npm run dev-no-server
```

Production

```
npm run prod
```

***3. Select theme***

Go to your WordPress and select the theme `jHuy`.

## Development

This project uses the Node package manager to build assets such as Sass. I've also included a VSCode setting to enable php-cs a Code-Sniffer to follow the WordPress standard to further add consistancy in code.

This is an open source project so please feel free to add changes.

## Testing

I've added `PHPUnit` has the testing framework of choice for this project.

***Prerequisites***

These are the requirements that have been tested.

- MySQL 14.14+ (running instance with access to database)
- SVN (download WordPress build)
- Bash (execute .sh install script)
- PHP 7.1+
- PHPUnit 6.4.3+ (optional: can use vendor/bin/phpunit provided by Composer)

***Run Install Shell Script***

What this script will do the following:

- Find WP_TESTS_DIR constant, otherwise SVN download a WordPress build at `/tmp`
- Set database info in configs
- Create database in MySQL instance

It is recommended to follow the `/tmp` temporary directory method. Run the following script:

```
bin/install-wp-tests.sh DATABASE_NAME DATABASE_USER DATABASE_PASSWORD HOST WORDPRESS_VERSION
```

Fill out the appropriate constant names as shown.

- DATABASE_NAME: your database name the script will create.
- DATABASE_USER: database username.
- DATABASE_PASSWORD: database password.
- HOST: recommended to use 127.0.0.1
- WORDPRESS_VERSION: recommended to use `latest` as the latest build of WordPress.

This script `bin/install-wp-tests.sh` was provided by WordPress CLI through the `$ wp-cli scaffold plugin-tests` command.

***Run Tests**

Running PHPUnit can be done through the global path with just `phpunit`.

If PHPUnit cannot be installed globally, then it be download through `vendor.json` in the project-space by running `composer install` at the root theme directory. Accesing the binary would be as shown:

```
vendor/bin/phpunit
```

## License

This project is licensed under the MIT License - see the LICENSE file for details
