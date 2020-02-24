<?php namespace App\Http\ViewComposers;

use Auth;

class NavbarComposer{

	public function compose($view){

		// Default nav
		$nav = [
			[
				'label'      => 'Dashboard',
				'route'      => 'admin.dashboard',
				'routeId'    => null,
				'iconClass'  => 'ion ion-home',
				'linkClass'  => '',
				'routeMatch' => 'admin.dashboard'
			],
			[
				'label'      => 'Budgets',
				'route'      => 'admin.budgets.index',
				'routeId'    => null,
				'iconClass'  => 'ion ion-pie-graph',
				'linkClass'  => '',
				'routeMatch' => 'admin.budgets*'
			],
		];

		if(!empty($view->budget)){
			$nav = [];

			if(!empty($view->budget->opened_at)){
				$nav[] = [
					'label'      => 'Results',
					'route'      => 'admin.budgets.show',
					'routeId'    => $view->budget->id,
					'iconClass'  => 'ion ion-stats-bars',
					'linkClass'  => '',
					'routeMatch' => 'admin.budgets.show'
				];
			}

			if(empty($view->budget->closed_at)){

				$nav[] = [
					'label'      => 'Organizations',
					'route'      => 'admin.budgets.organizations.index',
					'routeId'    => $view->budget->id,
					'iconClass'  => 'ion ion-ios-people',
					'linkClass'  => '',
					'routeMatch' => 'admin.budgets.organizations*'
				];

				$nav[] = [
					'label'      => 'Categories',
					'route'      => 'admin.budgets.categories.index',
					'routeId'    => $view->budget->id,
					'iconClass'  => 'ion ion-ios-list',
					'linkClass'  => '',
					'routeMatch' => 'admin.budgets.categories*'
				];

				$nav[] = [
					'label'      => 'Settings',
					'route'      => 'admin.budgets.edit',
					'routeId'    => $view->budget->id,
					'iconClass'  => 'ion ion-android-options',
					'linkClass'  => '',
					'routeMatch' => 'admin.budgets.edit'
				];

			}

			if($view->budget->is_active){
				$nav[] = [
					'label'      => 'Pause',
					'route'      => 'admin.budgets.pause',
					'routeId'    => $view->budget->id,
					'iconClass'  => 'ion ion-pause',
					'linkClass'  => '',
					'routeMatch' => ''
				];
				$nav[] = [
					'label'      => 'Close',
					'route'      => 'admin.budgets.close',
					'routeId'    => $view->budget->id,
					'iconClass'  => 'ion ion-stop',
					'linkClass'  => 'confirmable',
					'routeMatch' => ''
				];
			}else{
				if(empty($view->budget->closed_at)){
					$nav[] = [
						'label'      => (!empty($view->budget->opened_at) ? 'Re-open' : 'Open'),
						'route'      => 'admin.budgets.open',
						'routeId'    => $view->budget->id,
						'iconClass'  => 'ion ion-play',
						'linkClass'  => '',
						'routeMatch' => ''
					];
				}
			}

			$nav[] = [
				'label'      => 'Back to Budgets',
				'route'      => 'admin.budgets.index',
				'routeId'    => null,
				'iconClass'  => 'ion ion-chevron-left',
				'linkClass'  => '',
				'routeMatch' => ''
			];
		}

		$view->with('nav', $nav);

	}

}