<?php   

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$user->load(['permission_modules']);
$user->load(['user_catalogues']);
$user->load(['user_catalogues.permissions']);
$user_catalogues = DB::table('user_catalogues')->where('level','>', $user->user_catalogues->level)->get();
$dashboardMenu  = [
    'title' => 'Dashboard',
    'icon' => 'fa fa-database',
    'name' => ['dashboard'],
    'route' => 'dashboard',
    'class' => 'special'
];
if(!count($user->user_catalogues->permissions) && !count($user->permission_modules)){
    return ['module' => [$dashboardMenu]];
}
$userModules = [];
foreach($user->user_catalogues->permissions as $key => $val){
    $userModules[] = $val->module;
}
$userModules = array_unique($userModules);
$fullMenu = [
    'module' => [
        [
            'title' => 'Dashboard',
            'icon' => 'fa fa-database',
            'name' => ['dashboard'],
            'route' => 'dashboard',
            'class' => 'special'
        ],
        [
            'title' => 'QL Cán Bộ',
            'icon' => 'fa fa-user',
            'name' => ['users','user_catalogues', 'permissions', 'teams'],
            'items' => [
                [
                    'title' => 'QL Chức Vụ',
                    'route' => 'user_catalogues'
                ],
                [
                    'title' => 'QL Cán Bộ',
                    'route' => 'users'
                ],
                [
                    'title' => 'QL Quyền',
                    'route' => 'permissions'
                ],
                [
                    'title' => 'QL Đội',
                    'route' => 'teams'
                ],
            ]
        ],
    ]
];
$filteredModule = [];
foreach ($fullMenu['module'] as $module) {
    if (in_array('dashboard', $module['name'])) {
        $filteredModule[] = $module;
        continue;
    }
    $hasPermission = false;
    foreach ($module['name'] as $name) {
        if (in_array($name, $userModules)) {
            $hasPermission = true;
            break;
        }
    }
    if ($hasPermission) {
        if (isset($module['items'])) {
            $filteredItems = [];
            foreach ($module['items'] as $item) {
                $route = $item['route'];
                if (in_array($route, $userModules)) {
                    $filteredItems[] = $item;
                }
            }

            if (!empty($filteredItems)) {
                $module['items'] = $filteredItems;
                $filteredModule[] = $module;
            }
        } else {
            $filteredModule[] = $module;
        }
    }
}

if(!count($user->permission_modules)){
    return ['module' => $filteredModule];
}

/*User_permision_module*/

$userModulePermissions = [];
foreach($user->permission_modules as $k => $v){
    $userModulePermissions[] = $v->module;
}
$userModulePermissions = array_unique($userModulePermissions);
$modules = [
    'module' => 
    [
        [
            'title' => 'Tình hình đơn vị',
            'icon' => 'fa fa-github',
            'name' => ['units'],
            'route' => 'units'
        ],
        [
            'title' => 'PTVT XNC, QC',
            'icon' => 'fa fa-github',
            'name' => ['vehicles'],
            'route' => 'vehicles'
        ],
        [
            'title' => 'Hành khách XNC',
            'icon' => 'fa fa-github',
            'name' => ['passengers'],
            'route' => 'passengers'
        ],
        [
            'title' => 'TQ hàng hóa XNK',
            'icon' => 'fa fa-github',
            'name' => ['cargos'],
            'route' => 'cargos'
        ],
        [
            'title' => 'QL Rủi Ro',
            'icon' => 'fa fa-github',
            'name' => ['risks'],
            'route' => 'risks'
        ],
        [
            'title' => 'QL Thuế',
            'icon' => 'fa fa-github',
            'name' => ['taxes'],
            'route' => 'taxes'
        ],
        [
            'title' => 'Tham vấn',
            'icon' => 'fa fa-github',
            'name' => ['consultations'],
            'route' => 'consultations'
        ],
        [
            'title' => 'Kiểm tra STQ',
            'icon' => 'fa fa-github',
            'name' => ['checks'],
            'route' => 'checks'
        ],
        [
            'title' => 'DVCTT',
            'icon' => 'fa fa-github',
            'name' => ['digitals'],
            'route' => 'digitals'
        ],
        [
            'title' => 'XLVP HC / HS',
            'icon' => 'fa fa-github',
            'name' => ['violations'],
            'route' => 'violations'
        ],
        [
            'title' => 'Khác',
            'icon' => 'fa fa-github',
            'name' => ['others'],
            'route' => 'others'
        ],
        [
            'title' => 'Mặt hàng XNK',
            'icon' => 'fa fa-github',
            'name' => ['merchandises'],
            'route' => 'merchandises'
        ],
    ]
];
foreach($modules['module'] as $module){
    $hasPermission = false;
    foreach ($module['name'] as $name) {
        if (in_array($name, $userModulePermissions)) {
            $hasPermission = true;
            break;
        }
    }
    if ($hasPermission) {
        if (isset($module['items'])) {
            $filteredItems = [];
            foreach ($module['items'] as $item) {
                $route = $item['route'];
                if (in_array($route, $userModulePermissions)) {
                    $filteredItems[] = $item;
                }
            }

            if (!empty($filteredItems)) {
                $module['items'] = $filteredItems;
                $filteredModule[] = $module;
            }
        } else {
            $filteredModule[] = $module;
        }
    }
}
return ['module' => $filteredModule];