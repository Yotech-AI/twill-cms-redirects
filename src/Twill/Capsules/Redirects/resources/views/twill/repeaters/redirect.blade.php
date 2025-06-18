@twillRepeaterTitle('Redirect')
@twillRepeaterTrigger('Add redirect rule')
@twillRepeaterGroup('twill')

<x-twill::input name="from" label="From"/>
<x-twill::input name="to" label="To"/>
<x-twill::select name="statuscode" label="Status code" :options="[
    ['value' => 301, 'label' => '301'],
    ['value' => 302, 'label' => '302'],
    ['value' => 307, 'label' => '307'],
    ['value' => 308, 'label' => '308'],
]"/>
