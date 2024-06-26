<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Api_key;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Fields\Text;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Api_key>
 */
class Api_keyResource extends ModelResource
{
    protected string $model = Api_key::class;

    protected string $title = 'Api de tu servicio de inteligencia artificial';

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
        return ['id', 'service_name', 'api_key'];
    } 

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        // Obtener las chatbots desde la base de datos
 $api_keys = Api_key::all()->pluck('service_name', 'api_key', 'id')->toArray();

 // Depuración: Imprimir las categorías para verificar
 if (empty($api_keys)) {
     \Log::error('No api_keys found in the database.');
 } else {
     \Log::info('Api_keys found: ', $api_keys);
 }
  
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Servicio Api', 'service_name')
                ->default('api_key_ia') 
                ->required()
                ->disabled(),
                Text::make('Api key de tu servico de IA', 'api_key')->required(),
            ]),
        ];
    }

    /**
     * @param Api_key $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'service_name' => ['required', 'string', 'max:255'],
            'api_key' => ['required', 'string', 'max:255'],
        ];
    }
}
