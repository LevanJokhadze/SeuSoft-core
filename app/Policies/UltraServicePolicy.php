<?php

namespace App\Policies;

use App\Models\API\V1\Admin\Auth;
use App\Models\ultraService;
use Illuminate\Auth\Access\HandlesAuthorization;

class UltraServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\API\V1\Admin\Auth  $auth
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Auth $auth)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\API\V1\Admin\Auth  $auth
     * @param  \App\Models\ultraService  $ultraService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Auth $auth, ultraService $ultraService)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\API\V1\Admin\Auth  $auth
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Auth $auth)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\API\V1\Admin\Auth  $auth
     * @param  \App\Models\ultraService  $ultraService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Auth $auth, ultraService $ultraService)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\API\V1\Admin\Auth  $auth
     * @param  \App\Models\ultraService  $ultraService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Auth $auth, ultraService $ultraService)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\API\V1\Admin\Auth  $auth
     * @param  \App\Models\ultraService  $ultraService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Auth $auth, ultraService $ultraService)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\API\V1\Admin\Auth  $auth
     * @param  \App\Models\ultraService  $ultraService
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Auth $auth, ultraService $ultraService)
    {
        //
    }
}
