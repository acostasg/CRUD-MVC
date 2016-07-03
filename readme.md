## CRUD application to the practice of the University

In its core use mvc architectural pattern

This is a very basic app to upload a Tab file by a form and import data to a relational db.
I code the entire mvc structure, I trid to apply the basics things of sampler code filosofy, SOLID, patterns. this a very basic version.
In the main path you have an example tab file to upload, example_input.tab
## Requirments

To test the project you must have:
- composer
- mysql database


## deployment

- config your mysql connection on path: app/config/database.php
- run composer update to load related vendors.
- to start localhost/uoc/public/Home/index

## Security Vulnerabilities

The security is not implemented fullfuly in this project, dont be scared :D

## TODO
- escaping data
- validation of data
- template engine
- show the generated errors on loading on the html view
- patterns to let handle other delimiters type
- generation of Doc with phpDoc
...
