<?php

namespace App\Http\Traits;

trait HasCan
{
    public function getCanAttribute()
    {
        $authUser = request()->user();

        if ($authUser) {
            return [
                'view' => $authUser->can('view', $this),
                'edit' => $authUser->can('edit', $this),
                'show' => $authUser->can('show', $this),
                'update' => $authUser->can('update', $this),
                'delete' => $authUser->can('delete', $this),
            ];
        }
    }
}
