<p align="center"><a href="https://www.dot.co.id/" target="_blank"><img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEikw-f56L6-Ce0DtBECOLgxtdqhky0s-j9GFr71yow-8f-Q_rZDy1K26ibwcwo4OoZ2b58NZcODu1a469z8JQH_iyDNtWKoKRLe9RPw7D-h2R9YOCwfzkoUA_ungtwnqaWuWfmXKJ9haUTcueFakqH_AgE96va6MQg1VU9SIfTKhZf8JJLG3vasDyUJ/w680/icon-dot.png" width="200" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## DOT Sprint 2

- Membuat sumber data pencarian province & cities bisa melalui database​ atau direct API​ raja ongkir (swapable implementation).
- Proses swap implementasi dapat dilakukan melalui konfigurasi tanpa merubah source code yang sudah dibuat.
- Menyediakan API login agar endpoint pencarian hanya bisa diakses oleh authorized user saja.
- Membuat unit test / API test agar web service tetap reliable & maintainable


## Installation

Clone the repo locally:

```sh
git clone https://github.com/chimot3/sprint2.git dot-sprint-2 && cd dot-sprint-2
```

Install PHP dependencies:

```sh
composer install
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Fetch province and city data from Rajaongkir:

```sh
php artisan province-city:fetch
```

Install JWT

```sh
composer require tymon/jwt-auth
```

Generate JWT key

```sh
php artisan jwt:secret
```

Add DATA_SOURCE key to .env with value, "api" (if data from Rajaongkir API) or "database" (if data from database)

```sh
DATA_SOURCE=api
```


Run the dev server (the output will give the address, ex: https://127.0.0.1:8000):

```sh
php artisan serve
```


## Login API

Defalut email & password
- email : admin@gmail.com
- password : admin

### Request
<section id="province-request">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="province-request-url">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Method</td>
                                    <td>URL</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>POST</td>
                                    <td>https://127.0.0.1:8000/api/login</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="province-request-parameter">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Method</td>
                                    <td>Parameter</td>
                                    <td>Required</td>
                                    <td>Type</td>
                                    <td>Description</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>POST</td>
                                    <td>email</td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>Email Address</td>
                                </tr>
                                <tr>
                                    <td>POST</td>
                                    <td>password</td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>Password</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </section>

### Response

#### Success Response
```sh
{
    "success": true,
    "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@gmail.com",
        "email_verified_at": null,
        "created_at": "2023-09-08T11:08:16.000000Z",
        "updated_at": "2023-09-08T11:08:16.000000Z"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2RvdC1zcHJpbnQtMi50ZXN0L2FwaS9sb2dpbiIsImlhdCI6MTY5NDE3MjMxMiwiZXhwIjoxNjk0MTc1OTEyLCJuYmYiOjE2OTQxNzIzMTIsImp0aSI6IkVzNXVXdjNrdVJqS3pLYmMiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.qme1fvKZI1ive3o6OMnn20Q_PhDTqF_cx5eqe8zvSYg"
}
```

#### Response detail
<table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Component</td>
                                    <td>Type</td>
                                    <td>Description</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>id</td>
                                    <td>Integer</td>
                                    <td>User ID</td>
                                </tr>
                                <tr>
                                    <td>name</td>
                                    <td>String</td>
                                    <td>Name</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td>String</td>
                                    <td>User Email</td>
                                </tr>
                                <tr>
                                    <td>email_verified_at</td>
                                    <td>Timestamp</td>
                                    <td>Time email verified</td>
                                </tr>
                                <tr>
                                    <td>created_at</td>
                                    <td>Timestamp</td>
                                    <td>Time Created</td>
                                </tr>
                                <tr>
                                    <td>updated_at</td>
                                    <td>Timestamp</td>
                                    <td>Time Updated</td>
                                </tr>
                                <tr>
                                    <td>token</td>
                                    <td>String</td>
                                    <td>Token</td>
                                </tr>
                            </tbody>
                        </table>


#### Fail Response
##### email or password invalid

```sh
{
    "success": false,
    "message": "Email atau Password salah"
}
```

## Get data Province

### Request

fill Authorization parameter with "Bearer {TOKEN GET FROM LOGIN}"

<section id="province-request">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="province-request-url">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Method</td>
                                    <td>URL</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GET</td>
                                    <td>https://127.0.0.1:8000/api/search/provinces</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="province-request-parameter">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Method</td>
                                    <td>Parameter</td>
                                    <td>Required</td>
                                    <td>Type</td>
                                    <td>Description</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GET</td>
                                    <td>id</td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>Provincy ID</td>
                                </tr>
                                <tr>
                                    <td>GET/HEAD</td>
                                    <td>Authorization</td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>Authorization for JWT</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </section>

### Response

#### Success Response
```sh
{
    "success": true,
    "result": [
        {
            "province_id": 1,
            "province": "Bali"
        }
    ]
}
```

#### Response detail
<table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Component</td>
                                    <td>Type</td>
                                    <td>Description</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>province_id</td>
                                    <td>Integer</td>
                                    <td>Provincy ID</td>
                                </tr>
                                <tr>
                                    <td>province</td>
                                    <td>String</td>
                                    <td>Provincy Name</td>
                                </tr>
                            </tbody>
                        </table>


#### Fail Response
##### ID not provided
```sh
{
    "success": false,
    "message": "ID not provided"
}
```
##### Authorization Fail ( Invalid Token)
```sh
{
    "message": "Unauthenticated."
}
```


## Get data City

### Request
<section id="province-request">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="province-request-url">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Method</td>
                                    <td>URL</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GET</td>
                                    <td>https://127.0.0.1:8000/api/search/cities</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="province-request-parameter">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Method</td>
                                    <td>Parameter</td>
                                    <td>Required</td>
                                    <td>Type</td>
                                    <td>Description</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GET</td>
                                    <td>id</td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>City ID</td>
                                </tr>
                                <tr>
                                    <td>GET</td>
                                    <td>province</td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>Province ID</td>
                                </tr>
                                <tr>
                                    <td>GET/HEAD</td>
                                    <td>Authorization</td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>Authorization for JWT</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </section>

### Response

#### Success Response
```sh
{
    "success": true,
    "result": [
        {
            "city_id": 39,
            "province_id": 5,
            "province": "DI Yogyakarta",
            "type": "Kabupaten",
            "city_name": "Bantul",
            "postal_code": "55715"
        }
    ]
}
```

#### Response detail
<table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Component</td>
                                    <td>Type</td>
                                    <td>Description</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>city_id</td>
                                    <td>Integer</td>
                                    <td>City ID</td>
                                </tr>
                                <tr>
                                    <td>province_id</td>
                                    <td>Integer</td>
                                    <td>Provincy ID</td>
                                </tr>
                                <tr>
                                    <td>type</td>
                                    <td>String</td>
                                    <td>City type</td>
                                </tr>
                                <tr>
                                    <td>city_name</td>
                                    <td>String</td>
                                    <td>City Name</td>
                                </tr>
                                <tr>
                                    <td>postal_code</td>
                                    <td>String</td>
                                    <td>City Postalcode</td>
                                </tr>
                            </tbody>
                        </table>


#### Fail Response
##### ID not provided
```sh
{
    "success": false,
    "message": "ID not provided"
}
```
##### Authorization Fail ( Invalid Token)
```sh
{
    "message": "Unauthenticated."
}
```


