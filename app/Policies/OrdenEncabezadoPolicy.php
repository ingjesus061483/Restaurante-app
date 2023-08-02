<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\OrdenEncabezado;
use App\Models\User;

class OrdenEncabezadoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrdenEncabezado $ordenEncabezado): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrdenEncabezado $ordenEncabezado): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrdenEncabezado $ordenEncabezado): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OrdenEncabezado $ordenEncabezado): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OrdenEncabezado $ordenEncabezado): bool
    {
        //
    }
}
