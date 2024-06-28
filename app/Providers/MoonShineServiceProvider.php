<?php

declare(strict_types=1);

namespace App\Providers;
use App\MoonShine\Resources\ChatbotResource;
use App\MoonShine\Resources\ClosesessionResource;
use App\MoonShine\Resources\FlowResource;
use App\MoonShine\Resources\WelcomeResource;
use App\MoonShine\Resources\ChatiaResource;
use App\MoonShine\Resources\PromptResource;
use App\MoonShine\Pages\WebqrPage;
use App\MoonShine\Pages\WebqrIA;
use App\MoonShine\Resources\Api_keyResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Fields\File; 
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.users_title'),
                    new MoonShineUserResource()
                ),
                #COMENTADO PARA QUE NO MUESTRE LOS ROLES EN EL PANEL
                #MenuItem::make(
                 #   static fn() => __('moonshine::ui.resource.role_title'),
                  #  new MoonShineUserRoleResource()),
            ]),
            MenuItem::make('Chat con IA', new ChatiaResource())
            ->icon('heroicons.cpu-chip'),

            MenuItem::make('Prompts IA', new PromptResource())            
            ->icon('heroicons.document-text'),
                        
            MenuItem::make('QR con IA', new WebqrIA)
            ->icon('heroicons.qr-code'),

            MenuItem::make('Api key IA', new Api_keyResource())
            ->icon('heroicons.key'),

            MenuItem::make('Chat con Flujos', new ChatbotResource())
            ->icon('heroicons.chat-bubble-oval-left-ellipsis'),
            
            MenuItem::make('Flujos Chat', new FlowResource())            
            ->icon('heroicons.chat-bubble-left-right'),

            MenuItem::make('Mensaje Bienvenida', new WelcomeResource())
            ->icon('heroicons.hand-raised'),

            MenuItem::make('QR - Flujos', new WebqrPage)
            ->icon('heroicons.qr-code'),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
