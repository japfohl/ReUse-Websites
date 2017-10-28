# Getting Started

_Please refer to the README documentation contained in the test directory for more information on testing._

## Cloud9 Related Documentation

### Setup

* If you're getting setup to work in a Cloud9 dev environment, there's a super handy script that makes getting started easy as pie.  Just do the following in the project root:

```bash
$ ./bin/c9setup.sh
```

* Once the script is finished running, you'll be ready to serve the website using the built in C9 apache web server, run all your tests, and access the project's MySQL database.

### MySQL

* To interact with the MySQL server, the C9 environment provides the `mysql-ctl` command line utility.  For example:

```bash
# Start the server
$ mysql-ctl start

# Restart the server
$ mysql-ctl restart

# Stop the server
$ mysql-ctl stop

# Access the cli
$ mysql-ctl cli
```

* You've also got access to the standard set up MySQL utilities, most of which need to be prefaced with the `sudo` command in order to work.  For example:

```bash
# Execute a command in the cli and then quit.  "source someFile.sql;" can be any valid sql command.
$ sudo mysql c9 -N -e 'source someFile.sql;'
```

## Developing on OSX

* General dependencies are fairly easy to manage on OSX. First, it is heavily advised to update your PHP version to 7.0, or you may have difficulty running test.
```bash
$ curl -s https://php-osx.liip.ch/install.sh | bash -s 7.0
```

* Then in your bash profile (~/.profile) add this line: `export PATH=/usr/local/[php7 install location]/bin:$PATH`
where [php7 install location] is the location of the PHP binary in /usr/local/.

* You may want to check your PHP version to see that you've installed things correctly.
```bash
$ php -v
PHP 7.0.24 (cli) (built: Oct  2 2017 09:17:48) ( NTS )
Copyright (c) 1997-2017 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2017 Zend Technologies
    with Zend OPcache v7.0.24, Copyright (c) 1999-2017, by Zend Technologies
    with Xdebug v2.5.3, Copyright (c) 2002-2017, by Derick Rethans
```

* Next, you can install MySQL. On OSX it is advised to use the [Homebrew package manager](https://brew.sh/).
```bash
$ brew install mysql
```

* Then you'll want to create the database, create reasonable credentials and and ingest the SQL dump.
```bash
$ mysql -e "create database IF NOT EXISTS reuse_db;" -uroot
$ echo "USE mysql;\nUPDATE user SET password=PASSWORD('password') WHERE user='root';\nFLUSH PRIVILEGES;\n" | mysql -u root
$ mysql -uroot -ppassword reuse_db < data/ReUseDB.sql
```

* Then export the values necessary for the API to connect to MySQL, and for the test suite to connect to the API.
```bash
$ export REUSE_DB_USER=root
$ export REUSE_DB_PW=password
$ export REUSE_DB_URL=127.0.0.1
$ export REUSE_DB_NAME=reuse_db
$ export API_ADDR=127.0.0.1:8001 
```
Where 8001 can be any unused port number. Keep in mind this number must be the number you use to start the development server
in the section below.

## Developing on Windows

*** TODO!!

## General Information

### Starting a Development Server

* To start the development server on the localhost, enter the `public_html` directory.
```
$ cd public_html
```
* From here, you can start the application and API by just running the bundled PHP development server. More info on the PHP development server can be found [here](http://php.net/manual/en/features.commandline.webserver.php).
```
public_html $ php -S localhost:8001
```

Where 8001 can be any unused port number.

### Documentation

Here are links to the various tools / frameworks used for this project.
* [Slim Framework v2](http://docs.slimframework.com/)
* [Guzzle HTTP Client](http://docs.guzzlephp.org/en/stable/)
* [PHPUnit v5.7](https://phpunit.de/)
* [Faker - Fake Data Generator](https://github.com/fzaninotto/Faker)
* [Using MySQL in Cloud9](https://community.c9.io/t/setting-up-mysql/1718)
