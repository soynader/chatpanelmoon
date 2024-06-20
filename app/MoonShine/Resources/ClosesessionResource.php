<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Closesession;
use MoonShine\Fields\Number;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;

use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Closesession>
 */
class ClosesessionResource extends ModelResource
{
    protected string $model = Closesession::class;

    protected string $title = 'Closesessions';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    public function redirectAfterSave(): string
    {
        $request = request();
        $referer = $request->header('referer');
        return $referer ?: '/';
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make(),
                Number::make('received_welcome', 'received_welcome')->default('0'),
                
            ]),
        ];
    }

    /**
     * @param Closesession $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
