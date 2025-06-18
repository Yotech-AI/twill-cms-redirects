<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Http\Controllers;

use A17\Twill\Http\Controllers\Admin\SingletonModuleController as BaseModuleController;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Repeater;
use A17\Twill\Models\Contracts\TwillModelContract;

class RedirectController extends BaseModuleController
{
    protected string $moduleName = 'redirects';

    protected function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Input::make()->name('title')->label('Title')
        );

        $form->add(
            Repeater::make()->name('redirects')->label('Redirects')
        );

        return $form;
    }
}
