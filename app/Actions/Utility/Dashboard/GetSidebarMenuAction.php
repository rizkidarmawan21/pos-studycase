<?php

namespace App\Actions\Utility\Dashboard;

class GetSidebarMenuAction
{
    public function handle()
    {
        return [
            [
                'text' => 'Dashboard',
                'url'  => route('dashboard.index'),
                'icon' => 'VDashboard',
                'can'  => 'view_general_dashboard'
            ],
            [
                'text' => 'Category',
                'url'  => route('category.index'),
                'icon' => 'VTag',
                'can'  => 'view_settings_role_management'
            ],
            [
                'text' => 'Product',
                'url'  => route('product.index'),
                'icon' => 'VProduct',
                'can'  => 'view_settings_role_management'
            ],
            [
                'text' => 'Settings',
                'icon' => 'VSetting',
                'group' => true,
                'can'  => ['view_settings_role_management'],
                'submenu' => [
                    [
                        'text' => 'Role Management',
                        'url'  => route('settings.role.index'),
                        'can'  => 'view_settings_role_management',
                    ],
                    [
                        'text' => 'User Management',
                        'url'  => route('settings.user.index'),
                        'can'  => 'view_settings_role_management',
                    ],
                ],
            ],
        ];
    }
}
