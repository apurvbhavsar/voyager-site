# voyager-site

Voyager Site used to generate dynamic cms page with Laravel Voyager Admin.

### Installation

```bash
composer require apurv/voyager-site
```

If you already have tcg/voyager installed and setup then it will ingnore that package or else it will install and configure it manually

[Voyager Admin Installation](https://github.com/the-control-group/voyager)


### Regular Installation

```bash
php artisan site:install
```

### Manual Installation

```bash
php artisan vendor:publish --provider="Apurv\LaravelSite\VoyagerSiteProvider"
```

It will publish the **table** and **seeder** 

```bash
php artisan migrate
```

```bash
php artisan db:seed SiteDatabaseSeeder
```
