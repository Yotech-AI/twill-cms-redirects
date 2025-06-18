<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Repositories;

use A17\Twill\Repositories\Behaviors\HandleJsonRepeaters;
use A17\Twill\Repositories\ModuleRepository;
use TwillRedirects\Twill\Capsules\Redirects\Models\Redirect;

class RedirectRepository extends ModuleRepository
{
    use HandleJsonRepeaters;

    protected array $jsonRepeaters = ['redirects'];

    public function __construct(Redirect $model)
    {
        $this->model = $model;
    }
}
