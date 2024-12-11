<?php

namespace App\Policies;

use App\Models\Prisoner;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrisonerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAbility('prisoners.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Prisoner $prisoner): bool
    {
        return $user->hasAbility('prisoners.view');

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAbility('prisoners.create');

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Prisoner $prisoner): bool
    {
        return $user->hasAbility('prisoners.update');

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Prisoner $prisoner): bool
    {
        return $user->hasAbility('prisoners.delete');

    }


}
