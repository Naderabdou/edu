<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            [
                'key'      => 'logo',
                'neckname' => 'الشعار',
                'type'     => 'file',
                'value'    => 'setting/logo.png',
            ],
            [
                'key'      => 'footer_logo',
                'neckname' => 'الشعار السفلى',
                'type'     => 'file',
                'value'    => 'setting/logo.png',
            ],
            [
                'key'      => 'favicon',
                'neckname' => 'ايقونة الموقع',
                'type'     => 'file',
                'value'    => 'setting/favicon.ico',
            ],
            [
                'key'      => 'about_image',
                'neckname' => 'صورة عن التطبيق',
                'type'     => 'file',
                'value'    => 'setting/about.png',
            ],
            [
                'key'      => 'main_title_ar',
                'neckname' => 'العنوان الرئيسى بالعربية',
                'type'     => 'text',
                'value'    => 'زاد - زادك في اليوم والليلة'
            ],
            [
                'key'      => 'main_title_en',
                'neckname' => 'العنوان الرئيسى بالانجليزيه',
                'type'     => 'text',
                'value'    => 'Zad - Your increase for the day and night'
            ],
            [
                'key'      => 'main_desc_ar',
                'neckname' => 'النص الرئيسى بالعربيه',
                'type'     => 'textarea',
                'value'    => 'تطبيق زاد يحتوي علي كل ما يحتاجه المسلم في يومه وليلته من القران واذكار الصباح والمساء والادعية والمزيد....'
            ],
            [
                'key'      => 'main_desc_en',
                'neckname' => 'النص الرئيسى بالانجليزيه',
                'type'     => 'textarea',
                'value'    => "Zad application contains everything a Muslim needs in his day and night, including the Qur’an, morning and evening remembrances, supplications, and more...."
            ],
            [
                'key'      => 'footer_desc_ar',
                'neckname' => 'النص السفلى بالعربيه',
                'type'     => 'textarea',
                'value'    => 'التطبيق الاسلامي الجامع للكثير من الميزات التي يحتاجها المسلم '
            ],
            [
                'key'      => 'footer_desc_en',
                'neckname' => 'النص السفلى بالانجليزيه',
                'type'     => 'textarea',
                'value'    => "The Islamic application includes many features that a Muslim needs"
            ],

            [
                'key'      => 'about_application_ar',
                'neckname' => 'عن التطبيق بالعربيه',
                'type'     => 'textarea',
                'value'    => 'تطبيق "زاد": رفيقك الروحي في رحلة الإيمان
                زاد هو تطبيق ديني شامل يقدم لك مجموعة واسعة من الأذكار والأدعية، بالإضافة إلى القرآن الكريم ومواقيت الصلاة والقبلة. يتميز التطبيق بتصميمه الجذاب وسهولة استخدامه، مما يجعله رفيقك المثالي في رحلة الإيمان.'
            ],
            [
                'key'      => 'about_application_en',
                'neckname' => 'عن التطبيق بالانجليزيه',
                'type'     => 'textarea',
                'value'    => '“Zad” application: your spiritual companion on the journey of faith
                Zad is a comprehensive religious application that offers you a wide range of dhikr and supplications, in addition to the Holy Quran, prayer times, and the Qibla. The application is distinguished by its attractive design and ease of use, making it your ideal companion on the journey of faith.'
            ],

            [
                'key'      => 'privacy_policy_ar',
                'neckname' => 'سياسية الخصوصية بالعربيه',
                'type'     => 'textarea',
                'value' => 'تطبيق "زاد": رفيقك الروحي في رحلة الإيمان
                زاد هو تطبيق ديني شامل يقدم لك مجموعة واسعة من الأذكار والأدعية، بالإضافة إلى القرآن الكريم ومواقيت الصلاة والقبلة. يتميز التطبيق بتصميمه الجذاب وسهولة استخدامه، مما يجعله رفيقك المثالي في رحلة الإيمان.'
            ],
            [
                'key'      => 'privacy_policy_en',
                'neckname' => 'سياسية الخصوصية بالانجليزيه',
                'type'     => 'textarea',
                'value'    => '“Zad” application: your spiritual companion on the journey of faith
                Zad is a comprehensive religious application that offers you a wide range of dhikr and supplications, in addition to the Holy Quran, prayer times, and the Qibla. The application is distinguished by its attractive design and ease of use, making it your ideal companion on the journey of faith.'
            ],

            [
                'key'      => 'play_store',
                'neckname' => 'رابط التطبيق android',
                'type'     => 'url',
                'value'    => 'https://play.google.com/store/apps?hl=en&gl=US'
            ],
            [
                'key'      => 'app_store',
                'neckname' => 'رابط التطبيق ios',
                'type'     => 'url',
                'value'    => 'https://www.apple.com/eg/app-store/'
            ],
            [
                'key'      => 'email',
                'neckname' => 'البريد الإلكترونى',
                'type'     => 'email',
                'value'    => 'info@retaam.com'
            ],
            [
                'key'      => 'address',
                'neckname' => 'العنوان',
                'type'     => 'text',
                'value'    => 'رتام للحلول B1 مجمع تفاصل للأعمال، الرياض، المملكة العربية السعودية'
            ],
            [
                'key'      => 'lat',
                'neckname' => 'lat',
                'type'     => 'hidden',
                'value'    => '-33.8688'
            ],
            [
                'key'      => 'lng',
                'neckname' => 'lng',
                'type'     => 'hidden',
                'value'    => '151.2195'
            ],

            [
                'key'      => 'facebook',
                'neckname' => 'فيسبوك',
                'type'     => 'url',
                'value'    => 'https://facebook.com'
            ],
            [
                'key'      => 'twitter',
                'neckname' => 'تويتر',
                'type'     => 'url',
                'value'    => 'https://twitter.com'
            ],
            [
                'key'      => 'instagram',
                'neckname' => 'انستاجرام',
                'type'     => 'url',
                'value'    => 'https://instagram.com'
            ],
            [
                'key'      => 'app_verse',
                'neckname' => 'آية التطبيق',
                'type'     => 'text',
                'value'    => '“وَتَزَوَّدُوا فَإِنَّ خَيْرَ الزَّادِ التَّقْوَى”'
            ],
        ]);
    }
}
