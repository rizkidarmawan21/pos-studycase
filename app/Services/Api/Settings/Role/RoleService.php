<?php

namespace App\Services\Api\Settings\Role;

use App\Models\Role;

class RoleService
{
    public function getData($request)
    {
        $search = $request->search;
        $id = $request->id;


        $query = Role::query();

        $query->when(request('search', false), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        });

        $query->when(request('id', false), function ($q) use ($id) {
            $q->where('id', $id);
        });

        return $query->paginate(10);
    }

    public function createData($request)
    {
        $request = $request->only(['role_name']);
        $query = Role::create(
            [
                'name' => $request['role_name']
            ]
        );

        return $query;
    }

    public function updateData($id, $request)
    {
        $request = $request->only(['role_name']);
        $query = Role::where('id', $id)->update(
            [
                'name' => $request['role_name']
            ]
        );

        return $query;
    }

    public function deleteData($id)
    {
        $query = Role::where('id', $id)->delete();

        return $query;
    }
}
