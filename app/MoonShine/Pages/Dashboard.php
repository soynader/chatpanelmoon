<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Pages\Page;
use MoonShine\Components\Html;
use MoonShine\Components\FlexibleRender;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Components\Badge;

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Guía de Uso para crear ChatBots de Whatsapp';
    }


    
    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
        return [

                        
            FlexibleRender::make('
                <h1>🔷 En esta plataforma puedes crear tus propios chatbots autorespondedores para WhatsApp.</h1>
                <br>
                <h2>🤖 Crea tu Chatbot con Inteligencia Artificial.</h2>
                <br>
                <h2>🫨 Crea tu Chatbot con Flujos definidos.</h2>
                <br>
                <h2>🔷 Si necesitas funciones adicionales, por favor hágamelo saber para poder implementarlas.</h2>
            </br>
            </br>
                    🤖 Para implementa inteligencia artificial en tu chatbot necesitas APIs como ChatGPT para aprovecha sus potentes funciones. Recuerda que el uso de estas APIs implica costos asociados al consumo.💵
            </br>
            </br>
                    🎯 Tu chatbot con flujos funciona sin inteligencia artificial, NO necesita API y NO hay costos asociados.🙂
            </br>
            </br>
                    🎦 Tutorial para crear Chatbots de Whatsapp con Inteligencia Artificial.👇
            </br>
            </br>
            <script src="https://fast.wistia.com/embed/medias/qtrskvbipb.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_embed wistia_async_qtrskvbipb seo=true videoFoam=false" style="height:473px;position:relative;width:840px"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/qtrskvbipb/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div>
            '
            ), 
              
        ];
	}
}
