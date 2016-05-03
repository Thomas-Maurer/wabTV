# WabTv skeletons

[![Build Status](https://api.travis-ci.org/cakephp/app.png)](https://travis-ci.org/cakephp/app)
[![License](https://poser.pugx.org/cakephp/app/license.svg)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](http://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](http://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar update`.

If Composer is installed globally, run
```bash
composer create-project --prefer-dist cakephp/app [app_name]
```

You should now be able to visit the path to where you installed the app and see
the setup traffic lights.

## Configuration

Read and edit `config/app.php` and setup the 'Datasources' and any other
configuration relevant for your application.

## Node Chat

Go to `WabTV/webroot/js/`, run `npm install` and `bower install` to get all our dependencies.
To run the node server you need to replace in `WabTV/js/services/services.js` `io.connect('http://192.168.100.10:3000')`
 by `io.connect('http://yourIP:3000')`
Then just `node server.js`

## BDD Seed

Create Database name wabtv. then run `bin/cake migrations migrate` Then `bin/cake migrations seed --seed Users` and
`bin/cake migrations seed`
