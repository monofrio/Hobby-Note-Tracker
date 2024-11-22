<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder as BaseBuilder;

class Builder extends BaseBuilder
{
    /**
     * Add any custom query scopes here, e.g., for archived plants.
     */

    public function archived()
    {
        return $this->where('archived', true);
    }

    public function active()
    {
        return $this->where('archived', false);
    }
}
