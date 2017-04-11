<?php

namespace App\Http\Middleware;

use Closure;
use Lavary\Menu\Builder;
use \Menu;

class CreateMenu {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		Menu::make( 'LeftMenu', function ( Builder $menu ) {

			$menu->add( 'Dashboard', [ 'route' => 'dashboard' ] )
			     ->prepend( self::getIcon( 'tachometer' ) );
			$menu->add( 'Archive' )
			     ->prepend( self::getIcon( 'archive' ) );
			$menu->add( 'Trends' )
			     ->prepend( self::getIcon( 'bar-chart' ) );
			$menu->add( 'Statistics' )
			     ->prepend( self::getIcon( 'list' ) );
			$menu->add( 'Compare' )
			     ->prepend( self::getIcon( 'balance-scale' ) );

			$menu->divide();

			$menu->add( 'Status' )
			     ->prepend( self::getIcon( 'heartbeat' ) );

			$menu->divide();

			$menu->add( 'Export' )
			     ->prepend( self::getIcon( 'download' ) );
			$menu->add( 'Configuration', [ 'route' => 'configuration' ] )
			     ->prepend( self::getIcon( 'sliders' ) );

			$menu->divide();

			$menu->add( 'Documentation / FAQ' )
			     ->prepend( self::getIcon( 'question' ) );
			$menu->add( 'Feedback' )
			     ->prepend( self::getIcon( 'bullhorn' ) );
		} );

		return $next( $request );
	}

	private static function getIcon( $name ) {
		return "<i class='fa fa-$name'></i>";
	}
}
