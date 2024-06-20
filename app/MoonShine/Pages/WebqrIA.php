<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Pages\Page;
use MoonShine\Components\Html;
use MoonShine\Components\FlexibleRender;
class WebqrIA extends Page
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
        return $this->title ?: 'Escanea tu QR para el Chatbot con IA';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        return [
            FlexibleRender::make('
            <h1 style="text-align: center;">🤖 Escanea el código QR desde la aplicación de WhatsApp para poner tu bot con IA en producción.🤖
                <br>
                🔴 Por favor, refresca la página.🔴
                <br>
                El código QR se actualiza aproximadamente cada 60 segundos.</h1>

            <img style="display: block;-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="https://boti.zeabur.app/qr.png?time=67">'), 
              
        ];
    }
}
