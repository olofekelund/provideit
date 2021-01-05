### Setup
 - Klona repot
 - `composer install`
 - `npm install`
 - `npm run dev`
 - `./vendor/bin/sail up`
 - `./vendor/bin/sail artisan migrate`

### Endpoints

## api/address/autocomplete
Har inte blivit färdig med denna. I nuläget så kör den en hårdkodad request mot itunes och hämtar poddar, sedan går den igenom dem och hämtar RSS'n och lägger in avsnitten i databasen.

```json
{
	"address": "anekdotgatan"
}
```

## api/address/createRoute

```json
{
	"fromAddress": {
		"lat": 57.69218,
		"lng": 11.91749
	},
	"toAddress": {
		"lat": 57.72804,
		"lng": 11.96445
	}
}
```

## api/podcast/search

```json
{}

```
