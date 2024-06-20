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
                <h2>🔷 Estamos trabajando para implementar chatbots inteligentes con IA.</h2>
                <br>
                <h2>☠️ No hemos agregado funciones para envío masivo debido a los cierres de cuentas de WhatsApp☢️ por parte de Meta debido al incumplimiento de las políticas.</h2>
                <br>
                <h2>🔷 Si necesitas funciones adicionales, por favor hágamelo saber para poder implementarlas.</h2>
            </br>
            <iframe width="860" height="515" src="https://www.youtube.com/embed/3c_Ri_h0ecY?si=FRzIxIZ3lfLVPEeR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'
            
            ), 
              
        ];
	}
}
