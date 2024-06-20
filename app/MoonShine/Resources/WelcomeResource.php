<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Welcome;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Textarea;

use MoonShine\Components\Layout\Header;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Search; 
use MoonShine\Contracts\MoonShineLayoutContract;


/**
 * @extends ModelResource<Welcome>
 */
class WelcomeResource extends ModelResource
{
    protected string $model = Welcome::class;

    protected string $title = 'Mensaje Bienvenida + Mensaje por defecto + Duracion sesión';

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
        return ['id', 'welcomereply', 'defaultreply', 'session_duration'];
    } 

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        // Obtener las chatbots desde la base de datos
 $welcomes = Welcome::all()->pluck('welcomereply', 'defaultreply', 'id')->toArray();

 // Depuración: Imprimir las categorías para verificar
 if (empty($welcomes)) {
     \Log::error('No chatbot found in the database.');
 } else {
     \Log::info('Welcomes found: ', $welcomes);
 }
        return [
            Block::make([
                ID::make(),
                Textarea::make('Mensaje de bienvenida', 'welcomereply')->required(),
                Textarea::make('Mensaje por defecto', 'defaultreply')->required(),
                Number::make('Duracion sesión', 'session_duration'),
            ]),
        ];
    }

    /**
     * @param Welcome $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'welcomereply' => ['required', 'string', 'max:255'],
            'defaultreply' => ['required', 'string', 'max:255'],
            'session_duration' => ['integer', 'max:99'],
        ];
    }

}
