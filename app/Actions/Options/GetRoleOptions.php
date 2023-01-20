<?php

namespace App\Actions\Options;

use App\Models\Role;


class GetRoleOptions
{
    public function handle()
    {
        $role = Role::get()->pluck('name', 'id');

        return $role;
    }
}
