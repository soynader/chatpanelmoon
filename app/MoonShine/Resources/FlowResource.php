<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Flow;
use App\Models\Chatbot;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Image; 
use MoonShine\Fields\Video; 
use MoonShine\Fields\File; 
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Field;
use MoonShine\Fields\Select;
use MoonShine\Fields\Textarea;
use Illuminate\Support\Str;
use MoonShine\Components\MoonShineComponent;


/**
 * @extends ModelResource<Flow>
 */
class FlowResource extends ModelResource
{
    protected string $model = Flow::class;

    protected string $title = 'Flujos para los Chatbots';

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
        return ['id', 'keyword', 'answer', 'media_path', 'media_url', 'chatbots_id'];
    }
    
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
          // Obtener las categorías desde la base de datos
          $chatbots = Chatbot::all()->pluck('name', 'id')->toArray();

          // Depuración: Imprimir las categorías para verificar
          if (empty($chatbots)) {
              \Log::error('No flows found in the database.');
          } else {
              \Log::info('Flow found: ', $chatbots);
          }
        return [
            Block::make([
                ID::make(),
                Text::make('Palabra clave', 'keyword')->required(),  
                Textarea::make('Respuesta', 'answer')->required(),
                Select::make('Chatbot', 'chatbots_id')
                ->options($chatbots)
                ->searchable()
                ->required(),
                File::make('Imagen/Video/Doc', 'media_path')
                ->keepOriginalFileName()
                ->names(fn(string $filename, int $index = 0) => 'Archivo')
                ->disk('public')
                ->dir('media'),               
            ]),
        ];
    }
    
    /**
     * @param Flow $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'keyword' => ['required', 'string', 'max:255'],
            'answer' =>  ['required', 'text',],
            'media_path' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,mp4,avi,mkv,pdf,doc,docx,xlsx', 'max:20480'],
            'chatbots_id' => ['required', 'exists:chatbots,id'],
        ];
    }
}
