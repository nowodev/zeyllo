<p align="center">

# Zeyllo

</p>

## Installation

Clone the repo

    git clone https://github.com/nowodev/zeyllo.git

Navigate into the folder `zeyllo`

Run the migrations and seed the database

    php artisan migrate --seed

Serve the project locally

    php artisan serve

## Usage

#### Note that only authenticated users can perform any operation.

### Authentication Endpoints

```
    [POST] Register:                    /api/register
    [POST] Login:                       /api/login
```

The registration endpoint accepts 4 values:

```
    name,
    email,
    password,
    confirm_password
```

The login endpoint accepts 2 values:

```
    email, 
    password
```

### Product Endpoints

[//]: # (    [POST] Create:                      /api/inventory)
[//]: # (    [GET] Fetch/Read All Products:     /api/v1/products)
[//]: # (    [GET] Fetch/Read Single Product:  /api/v1/products/{id})
    [GET] Fetch Popular Product:  /api/v1/products/popular
    [GET] Fetch Recommended Product:  /api/v1/products/recommended
