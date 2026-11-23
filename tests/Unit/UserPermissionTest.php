<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserPermissionTest extends TestCase
{
    public function test_user_without_role_does_not_crash_on_permission_checks(): void
    {
        $user = new User();
        $user->role_id = null;

        $this->assertNull($user->permissions());
        $this->assertFalse($user->hasPermission('manage_users'));
    }
}


