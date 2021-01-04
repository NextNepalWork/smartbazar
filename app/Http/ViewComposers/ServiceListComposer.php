<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/19/2019
 * Time: 4:52 PM
 */

namespace App\Http\ViewComposers;


use App\Model\ServiceCategory;
use Illuminate\View\View;


class ServiceListComposer
{
    public function compose(View $view)
    {
        $serviceCategories = ServiceCategory::all();

        $view->with([
            'serviceCategories' => $serviceCategories
        ]);
    }

}