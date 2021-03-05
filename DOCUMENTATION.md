# Usage

First, create a `div` element where you want top show your map in:

```html
<div id="my-map" class="h-72"></div>
```

Assign an `id` that you pass to your `here_map` tag. Also make sure, that your `div` element does have
a valid height, otherwise your map won't render.

## Show map by latitude & longitude

```
{{ here_map container="my-map" lat="12.34" lon="98.76" zoom="13" }}
```

## Show map by address

```
{{ here_map:address container="my-map" street="Street 123" zipcode="12345" city="Demo City" }}
```

## Parameters

**marker**, default: `false`  
Shows a marker for the given location.

# Customization

Views and config settings can be tweaked by you. You just need to run

```
php artisan vendor:publish --tag=config --provider="Codedge\HereMaps\ServiceProvider"
```

```
php artisan vendor:publish --tag=views --provider="Codedge\HereMaps\ServiceProvider"
```

to publish all assets things you like to modify.
