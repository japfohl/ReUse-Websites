# Getting Started With Phinx

**TODO**: Integrate this into the main README.md

*  If you haven't already, run a composer update in the root of the project:

```bash
$ php ./composer.phar update
```

* Next initialize phinx:

```bash
$ bin/phinx init
```

* This will create a `phinx.yml` file that you should open with your favorite editor and update, replacing the values 
for `host`, `name`, `user`, and `pass`:

```yml
paths:
    migrations: %%PHINX_CONFIG_DIR%%/db/migrations
    seeds: %%PHINX_CONFIG_DIR%%/db/seeds

environments:
    default_migration_table: phinxlog
    default_database: development
    development:
        adapter: mysql
        host: yourLocalDbAddress
        name: yourLocalDbName
        user: yourLocalDbUser
        pass: yourLocalDbPassword
        port: 3306
        charset: utf8

version_order: creation
```

* Once that's complete you should be able to run:

```bash
$ bin/phinx migrate
```

_This will apply all of the database migrations to your local database (assuming you updated the config file correctly
and haven't made any other crazy changes to the database)._

* For more information on the cli and writing your own database migrations,  see the
[documentation](http://docs.phinx.org/en/latest/index.html).