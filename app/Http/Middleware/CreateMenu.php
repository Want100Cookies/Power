<?php

namespace App\Http\Middleware;

use Menu;
use Closure;
use Lavary\Menu\Builder;

class CreateMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::make('LeftMenu', function (Builder $menu) {
            $menu->add('Dashboard', ['route' => 'dashboard'])
                 ->prepend(self::getIcon('tachometer'))
                 ->data('root', true);
            $menu->add('Archive', ['route' => 'archive'])
                 ->prepend(self::getIcon('archive'));
            $menu->add('Trends', ['route' => 'trends'])
                 ->prepend(self::getIcon('bar-chart'));
            $menu->add('Statistics', ['route' => 'statistics'])
                 ->prepend(self::getIcon('list'));
            $menu->add('Compare', ['route' => 'compare'])
                 ->prepend(self::getIcon('balance-scale'));

            $menu->divide();

            $menu->add('Status', ['route' => 'status'])
                 ->prepend(self::getIcon('heartbeat'));

            $menu->divide();

            $menu->add('Export', ['route' => 'export'])
                 ->prepend(self::getIcon('download'));
            $menu->add('Configuration', ['route' => 'configuration'])
                 ->prepend(self::getIcon('sliders'));

            $menu->divide();

            $menu->add('Documentation / FAQ', ['route' => 'faq'])
                 ->prepend(self::getIcon('question'));
            $menu->add('Feedback', ['route' => 'feedback'])
                 ->prepend(self::getIcon('bullhorn'));
        });

        Menu::make('BreadCrumb', function ($menu) {
            $mainNav = Menu::get('LeftMenu');

            $menu->add('Dashboard', ['route' => 'dashboard'])
                 ->prepend(self::getIcon('tachometer'));

            foreach ($mainNav->items as $key => $item) {
                if ($item->attr('class') == 'active'
                     && (! array_key_exists('root', $item->data)
                          || $item->data['root'] !== true)
                ) {
                    $menu->add($item->title, ['route' => $item->link->path['route']]);
                }
            }
        });

        return $next($request);
    }

    private static function getIcon($name)
    {
        return "<i class='fa fa-$name'></i> ";
    }
}
