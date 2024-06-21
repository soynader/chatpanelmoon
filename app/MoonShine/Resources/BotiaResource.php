<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Botia;
use App\Models\Chatia;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Fields\Textarea;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Botia>
 */
class BotiaResource extends ModelResource
{
    protected string $model = Botia::class;

    protected string $title = 'Prompt para los chatbots con IA';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    public function redirectAfterSave(): string
    {
        $request = request();
        $referer = $request->header('referer');
        return $referer ?: '/';
    }
    public function search(): array 
    {
        return ['id', 'name', 'prompt', 'chatias_id'];
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
            // Obtener las categorías desde la base de datos
            $chatias = Chatia::all()->pluck('name', 'id')->toArray();

            // Depuración: Imprimir las categorías para verificar
            if (empty($chatias)) {
                \Log::error('No flows found in the database.');
            } else {
                \Log::info('Flow found: ', $chatias);
            }
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Nombre Bot-IA', 'name')->required(),  
                Textarea::make('Prompt', 'prompt')->required(),
                Select::make('Chat-IA', 'chatias_id')
                ->options($chatias)
                ->searchable()
                ->required(),
            ]),
        ];
    }

    /**
     * @param Botia $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'name' =>  ['required', 'string',],
            'prompt' => ['required', 'string', 'max:8000'],
            'chatias_id' => ['required', 'exists:chatias,id'],
        ];
    }
}
