<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DailyCareRecordPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user)
    {
        return in_array($user->role, ['manager', 'team_leader']);
    }

    protected $policies = [
        DailyCareRecord::class => DailyCareRecordPolicy::class,
    ];

}
