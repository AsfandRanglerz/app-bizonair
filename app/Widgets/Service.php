<?php

namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use Illuminate\Support\Facades\Auth;

class Service extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Subservice::count();
        $string = trans_choice('Services', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-star',
            'title'  => "{$count} {$string}",
            'text'   => '',
            'button' => [
                'text' => 'View All Services',
                'link' => route('voyager.subservices.index'),
            ],
            'image' => '',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('User'));
    }
}
