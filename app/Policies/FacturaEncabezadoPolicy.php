<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\FacturaEncabezado;
use App\Models\User;

class FacturaEncabezadoPolicy
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
    public function view(User $user, FacturaEncabezado $facturaEncabezado): bool
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
    public function update(User $user, FacturaEncabezado $facturaEncabezado): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FacturaEncabezado $facturaEncabezado): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FacturaEncabezado $facturaEncabezado): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FacturaEncabezado $facturaEncabezado): bool
    {
        //
    }
}
