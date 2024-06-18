<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingRequest;
use App\Repositories\Contract\SettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {

        $this->settingRepository = $settingRepository;
    } // end of contruct

    public function create()
    {

        $settings = $this->settingRepository->getAll(['column' => 'id', 'dir' => 'ASC']);

        return view('dashboard.settings.edit', compact('settings'));
    } // end of create

    public function store(SettingRequest $request)
    {

        $attribute = $request->except('_token', '_method', 'logo', 'footer_logo', 'favicon', 'about_us_first_image', 'about_us_second_image');

        $logo                  = $this->settingRepository->getWhere([['key', 'logo']])->first()['value'];
        $footer_logo           = $this->settingRepository->getWhere([['key', 'footer_logo']])->first()['value'];
        $favicon               = $this->settingRepository->getWhere([['key', 'favicon']])->first()['value'];
        $slider_image       = $this->settingRepository->getWhere([['key', 'slider_image']])->first()['value'];
        $first_image_about    = $this->settingRepository->getWhere([['key', 'first_image_about']])->first()['value'];
        $second_image_about    = $this->settingRepository->getWhere([['key', 'second_image_about']])->first()['value'];
        $third_image_about    = $this->settingRepository->getWhere([['key', 'third_image_about']])->first()['value'];
        $new_collection_video    = $this->settingRepository->getWhere([['key', 'new_collection_video']])->first()['value'];
        $video_about    = $this->settingRepository->getWhere([['key', 'video_about']])->first()['value'];
        $image_about    = $this->settingRepository->getWhere([['key', 'image_about']])->first()['value'];
        $image_faqs    = $this->settingRepository->getWhere([['key', 'image_faqs']])->first()['value'];
        if ($request->has('image_faqs')) {

            // Delete old internal_image
            Storage::delete($image_faqs);

            // Upload new internal_image
            $attribute['image_faqs'] = $request->file('image_faqs')->store('setting');
        }
        if ($request->has('image_about')) {

            // Delete old internal_image
            Storage::delete($image_about);

            // Upload new internal_image
            $attribute['image_about'] = $request->file('image_about')->store('setting');
        }
        if ($request->has('video_about')) {

            // Delete old internal_image
            Storage::delete($video_about);

            // Upload new internal_image
            $attribute['video_about'] = $request->file('video_about')->store('setting');
        }
        if ($request->has('new_collection_video')) {

            // Delete old internal_image
            Storage::delete($new_collection_video);

            // Upload new internal_image
            $attribute['new_collection_video'] = $request->file('new_collection_video')->store('setting');
        }
        if ($request->has('third_image_about')) {

            // Delete old internal_image
            Storage::delete($third_image_about);

            // Upload new internal_image
            $attribute['third_image_about'] = $request->file('third_image_about')->store('setting');
        }
        if ($request->has('second_image_about')) {

            // Delete old internal_image
            Storage::delete($second_image_about);

            // Upload new internal_image
            $attribute['second_image_about'] = $request->file('second_image_about')->store('setting');
        }
        if ($request->has('second_image_about')) {

            // Delete old internal_image
            Storage::delete($first_image_about);

            // Upload new internal_image
            $attribute['first_image_about'] = $request->file('first_image_about')->store('setting');
        }
        if ($request->has('slider_image')) {

            // Delete old internal_image
            Storage::delete($slider_image);

            // Upload new internal_image
            $attribute['slider_image'] = $request->file('slider_image')->store('setting');
        }
        if ($request->has('logo')) {

            // Delete old internal_image
            Storage::delete($logo);

            // Upload new internal_image
            $attribute['logo'] = $request->file('logo')->store('setting');
        }

        if ($request->has('footer_logo')) {

            // Delete old internal_image
            Storage::delete($footer_logo);

            // Upload new internal_image
            $attribute['footer_logo'] = $request->file('footer_logo')->store('setting');
        }

        if ($request->has('favicon')) {

            // Delete old internal_image
            Storage::delete($favicon);

            // Upload new internal_image
            $attribute['favicon'] = $request->file('favicon')->store('setting');
        }

        if ($request->has('about_us_first_image')) {

            // Delete old internal_image
            Storage::delete($about_us_first_image);

            // Upload new internal_image
            $attribute['about_us_first_image'] = $request->file('about_us_first_image')->store('setting');
        }

        if ($request->has('about_us_second_image')) {

            // Delete old internal_image
            Storage::delete($about_us_second_image);

            // Upload new internal_image
            $attribute['about_us_second_image'] = $request->file('about_us_second_image')->store('setting');
        }

        $this->settingRepository->updateSetting($attribute);

        return redirect()->back()->with('success', __('models.update_success'));
    } // end of update
}
