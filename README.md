# jHuy WordPress Theme

This is my first WordPress theme created for my personal website at [johnnyhuy.com](http://johnnyhuy.com).

## Todo

- Release build (.zip) for normal upload installation. This build will have prebuilt assets.

## Getting Started

### Prerequisites

- NodeJS LTS installed on the environment
- WordPress application
- Directory access to WordPress content

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

## License

This project is licensed under the MIT License - see the LICENSE file for details
