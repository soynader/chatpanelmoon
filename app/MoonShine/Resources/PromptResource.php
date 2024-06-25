<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prompt;
use App\Models\Chatia;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Fields\Textarea;
use Illuminate\Support\Str;

/**
 * @extends ModelResource<Prompt>
 */
class PromptResource extends ModelResource
{
    protected string $model = Prompt::class;

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
        return ['id', 'content', 'prompt_type', 'chatias_id'];
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
                Select::make('Tipo_Prompts', 'prompt_type')->options([
                    'ENTRENAR_BOT' => 'ENTRENAR_BOT',
                    'INFO_NEGOCIO' => 'INFO_NEGOCIO',
                     ])->required(),
                // Vista previa del contenido
                Textarea::make('Contenido', 'content', function ($item) {
                // Limitar el contenido a los primeros 100 caracteres
                return Str::limit($item->content, 150); }),                  
                Select::make('Nombre Chat-IA', 'chatias_id')
                ->options($chatias)
                ->searchable()
                ->required(),
            ]),
        ];
    }

    /**
     * @param Prompt $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'prompt_type' =>  ['required', 'in:ENTRENAR_BOT,INFO_NEGOCIO'],
            'content' => ['required', 'text'],
            'chatias_id' => ['required', 'exists:chatias,id'],
        ];
    }
}
