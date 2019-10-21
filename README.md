## Usage

### Configuration

1.  set following on application's composer.json
```
"extra": {
    "laravel": {
        "dont-discover": [
            "pdusan/simple-blog"
        ]
    }
},

"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Pdusan\\SimpleBlog\\": "vendor/pdusan/simple-blog/src/"
    },
},
```

2. config/app.php
```
'providers' => [
        ...
        Pdusan\SimpleBlog\SBlogServiceProvider::class,
 ],
 ```
 
### Publish

1. Publish configration
```
php artisan vendor:publish --tag="sblog-config"
```
2. Publish views
```
php artisan vendor:publish --tag="sblog-views"
```
3. Publish translations
```
php artisan vendor:publish --tag="sblog-translations"
```
4. Publish assets
```
php artisan vendor:publish --tag="sblog-assets"
```
5. Publish migrations
```
php artisan vendor:publish --tag="sblog-migrations"
```

### Make auth

```
php artisan make:auth
```

### DB Migration
```
php artisan migrate
```

### DB Seeder
```
php artisan db:seed --class=Pdusan\SimpleBlog\Seeds\SBlogSeeder
```