<?php

use Carbon\Carbon;
use App\Mail\WeHelp;
// use Stevebauman\Location\Facades\Location;
use App\Mail\BondMail;
use Twilio\Rest\Client;
use App\Servicies\Notify;
use App\Mail\SendCodeMail;
use App\Jobs\SendMultiMail;
use App\Jobs\SendEmailGifts;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\SendMailMarkting;
use App\Jobs\sendMailSubscribe;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use AmrShawky\LaravelCurrency\Facade\Currency;

/*curr
|--------------------------------------------------------------------------
| Detect Active Routes Function
|--------------------------------------------------------------------------
|
| Compare given routes with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/

function isActiveRoute($route, $output = "active")
{
    if (\Route::currentRouteName() == $route) return $output;
}

function areActiveRoutes(array $routes, $output = "active show-sub")
{

    foreach ($routes as $route) {
        if (\Route::currentRouteName() == $route) return $output;
    }
}

function areActiveMainRoutes(array $routes, $output = "active")
{

    foreach ($routes as $route) {
        if (\Route::currentRouteName() == $route) return $output;
    }
}

function getSetting($key, $lang = null)
{

    $sittingrepository =  App::make('App\Repositories\Contract\SettingRepositoryInterface');

    if ($lang == null) {

        $setting = $sittingrepository->getWhere([['key', $key]])->first()['value'];
    } else {

        $setting = $sittingrepository->getWhere([['key', $key . '_' . $lang]])->first()['value'];
    }

    return $setting;
}

function transWord($word, $locale = null)
{

    if (!$locale) {
        $locale = app()->getLocale();
    }

    $translationsFile = 'translations.json';

    // Check if the translations file exists, and create it if not
    if (!file_exists($translationsFile)) {
        file_put_contents($translationsFile, json_encode([], JSON_PRETTY_PRINT));
    }

    // Load existing translations from the JSON file
    $translations = json_decode(file_get_contents($translationsFile), true);

    // Check if the translation already exists for the given word and locale
    if (isset($translations[$locale][$word])) {
        $translatedWord = $translations[$locale][$word];
    } else {
        // If not found, translate the word
        $translateClient = new \Stichoza\GoogleTranslate\GoogleTranslate();
        $translatedWord = $translateClient->setSource(null)->setTarget($locale)->translate($word);

        // Save the translated word to the JSON file
        $translations[$locale][$word] = $translatedWord;
        file_put_contents($translationsFile, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    return $translatedWord;
}

function getCount(string $model , $role = null)
{
    $modelClass = "App\Models\\" . ucfirst($model);

    $count = 0;

    if (class_exists($modelClass)) {
        if ($role) {

            $instance = new $modelClass;
            $count = $instance->role($role)->count();
        } else {
            $instance = new $modelClass;
            $count = $instance->count();
        }

    }

    return $count;
}
function SendCode($email, $code,$name)
{

    $data = [
        'code'  => $code,
        'name'  => $name
    ];

    Mail::to($email)->send(new SendCodeMail($data));

    return true;
} // end of send code

