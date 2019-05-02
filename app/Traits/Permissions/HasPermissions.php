<?php

namespace App\Traits\Permissions;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissions
{
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions(array_flatten($permissions));
        if (!$permissions->count()) {
            return $this;
        }
        /* todo: chose between saveMany() and attach() methods */
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function withdrawPermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions(array_flatten($permissions));
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function updatePermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionTo($permissions);
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role){
            if ($this->roles->contains('name', ucfirst(strtolower($role)))) {
                return true;
            }
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }

    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    protected function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission)
    {
        return  $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }
}