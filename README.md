# jHuy WordPress Theme

This is my first WordPress theme created for my personal website at [johnnyhuy.com](http://johnnyhuy.com).

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

Development: build

```
npm run dev
```

Development: watch

Production

```
npm run prod
```

***3. Select theme***

Go to your WordPress and select the theme `jHuy`.

## License

This project is licensed under the MIT License - see the LICENSE file for details
