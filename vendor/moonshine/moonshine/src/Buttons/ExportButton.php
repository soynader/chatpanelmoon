<?php

namespace MoonShine\Buttons;

use Illuminate\Support\Arr;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Resources\ModelResource;

final class ExportButton
{
    public static function for(ModelResource $resource, ExportHandler $export): ActionButton
    {
        $query = Arr::query(request(['filters', 'sort', 'query-tag'], []));
        $url = $resource->route('handler', query: ['handlerUri' => $export->uriKey()]);

        return ActionButton::make(
            $export->label(),
            $url . ($query ? '?' . $query : '')
        )
            ->primary()
            ->customAttributes(['class' => '_change-query', 'data-original-url' => $url])
            ->icon($export->iconValue());
    }
}
