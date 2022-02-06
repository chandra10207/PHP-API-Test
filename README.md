
# Winning PHP test

Simple PHP REST API application based on Laravel framework.


##Installation

Extract Zipped file on you favourite local server directory:

Wampp & Ampps --- Extract to www folder

Xampp --- Extract to htdocs folder

You will see winningtest folder on those directory.

Now Run your server and goto localhost/winningtest. Change your localdost port accordingly if needed.

You will see the page with heading "Winning Test". Now you were good to go.

Your Base URL be:
http://localhost/winningtest/

 --- 

## Create New Products

Method: POST

Endpoint:
```
/api/products

```
Body content:
```
name -- alpha numeric value
price -- numeric value

```

Will return product ID on success.


## Get single static product details

Method: GET

Endpoint:
```
/assets/products/product_id.json

```

Test Data:
http://localhost/winningtest/assets/products/1.json
http://localhost/winningtest/assets/products/2.json


## Get All Products

Method: GET

Endpoint:
```
/api/products

```

or Static File:

/assets/products/all_products.json

