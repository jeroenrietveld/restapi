#Rest API
This is a restful webservice which makes use of the Doctrine Object Relational mapper.

#installation
Start by getting a copy of the project.

`git clone git@github.com:jeroenrietveld/restapi.git`

To install this rest api there are a few simple steps to follow.

Composer is required to install doctrine and the symfony yaml parser, if you do not have composer install it now (http://getcomposer.org/doc/01-basic-usage.md).
Once composer is installed run `composer install` form the root directory of the project.

Change the `config\database.yml` to your database settings and create the database.
After that run `php vendor/bin/doctrine orm:schema-tool:update` from the root directory of the project.