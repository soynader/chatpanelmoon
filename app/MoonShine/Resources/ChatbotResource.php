<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Chatbot;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Textarea;

/**
 * @extends ModelResource<Welcome>
 */
class ChatbotResource extends ModelResource
{
    protected string $model = Chatbot::class;

    protected string $title = 'Nombre de los Chatbots con flujos';

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
        return ['id', 'name', 'estado'];
    } 

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
            // Obtener las chatbots desde la base de datos
    $chatbots = Chatbot::all()->pluck('name', 'estado', 'id')->toArray();

    // Depuración: Imprimir las categorías para verificar
    if (empty($chatbots)) {
        \Log::error('No chatbot found in the database.');
    } else {
        \Log::info('Chatbots found: ', $chatbots);
    }
        return [
            Block::make([
                ID::make(),
                Text::make('Nombre', 'name')->required(),
                Select::make('Estado', 'estado')->options([
                    'activo' => 'activo',
                    'inactivo' => 'inactivo',
                ])->required(), 
            ]),
        ];
    }

    /**
     * @param Chatbot $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'in:activo,inactivo'],
        ];
    }

}

