# Getting Started With Phinx

**TODO**: Integrate this into the main README.md

*  If you haven't already, run a composer update in the root of the project:

```bash
$ php ./composer.phar update
```

* Next, update the phinx.yml file at the root of the project.  It will already have a `travis` environment defined for 
the CI environment.  You have to add the `dev` environment for your local database:

```yml
paths:
    migrations: %%PHINX_CONFIG_DIR%%/db/migrations
    seeds: %%PHINX_CONFIG_DIR%%/db/seeds

environments:
    default_migration_table: phinxlog
    default_database: development
    dev:
        adapter: mysql
        host: YOUR_DB_ADDRESS_HERE
        name: YOUR_DB_NAME_HERE
        user: YOUR_DB_USER_HERE
        pass: YOUR_DB_PASSWORD_HERE
        port: 3306
        charset: utf8
    travis:
        adapter: mysql
        host: 127.0.0.1
        name: reuse_db
        user: root
        pass: password
        port: 3306
        charset: utf8

version_order: creation
```

**IMPORTANT NOTE**: Don't commit the dev environment change to git.  This is only for your local development environment.  The best
thing to do when making commits is to do a `git stash phinx.yml` before adding any changes, then `git stash pop` to get
back your configurations for the dev environment.  

**_TODO_**: Figure out a better way to not commit local dev environment stuff.

* Once that's complete you should be able to run:

```bash
$ bin/phinx migrate -e dev
```

_This will apply all of the database migrations to your local database (assuming you updated the config file correctly
and haven't made any other crazy changes to the database)._

* To rollback one migration:

```bash
$ bin/phinx rollback -e dev
```

* To rollback all changes to the database:

```bash
$ bin/phinx rollback -e dev -t 0
```

* For more information on the cli and writing your own database migrations,  see the
[Phinx documentation](http://docs.phinx.org/en/latest/index.html).