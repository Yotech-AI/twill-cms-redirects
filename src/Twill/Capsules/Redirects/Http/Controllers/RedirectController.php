<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Http\Controllers;

use A17\Twill\Http\Controllers\Admin\SingletonModuleController as BaseModuleController;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Select;
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
            InlineRepeater::make()
                ->name('redirects')
                ->label('Redirects')
                ->triggerText('Add redirect rule')
                ->fields([
                    Input::make()->name('from')->label('From'),
                    Input::make()->name('to')->label('To'),
                    Select::make()
                        ->name('statuscode')
                        ->label('Status code')
                        ->options([
                            ['value' => 301, 'label' => '301'],
                            ['value' => 302, 'label' => '302'],
                            ['value' => 307, 'label' => '307'],
                            ['value' => 308, 'label' => '308'],
                        ]),
                ])
        );

        return $form;
    }
}
