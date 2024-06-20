<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Chatia;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Chatia>
 */
class ChatiaResource extends ModelResource
{
    protected string $model = Chatia::class;

    protected string $title = 'Nombre de los Chatbot con IA';
    
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
    $chatias = Chatia::all()->pluck('name', 'estado', 'id')->toArray();

    // Depuración: Imprimir las categorías para verificar
    if (empty($chatias)) {
        \Log::error('No chatbot found in the database.');
    } else {
        \Log::info('Chatbots found: ', $chatias);
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
     * @param Chatia $item
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
