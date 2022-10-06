## Install

#### System requirements

- PHP:  ^8.0
- Git

#### Installation

- Run command `git clone git@github.com:sergeysksa/weather_api.git`
- copy `.env.example` to `.env`
- To the `.env` add necessary variables
- - GOOGLE_CLIENT_ID
- - GOOGLE_CLIENT_SECRET
- - GOOGLE_REDIRECT='http://localhost/callback'
- - WEATHER_API_KEY=
- - WEATHER_API_URL='https://api.openweathermap.org/data/2.5/weather?'
- - DEFAULT_USER_LOCATION='London'
- `composer install`
- `php artisan optimize`
- `php artisan migrate`
- `npm i`
- `npm run build`
- open in browser 'http://localhost'
