<?php

namespace App\Http\Controllers\Onboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Configuration\PermissionsChecker;

class PermissionsController extends Controller
{
    /**
     * @var PermissionsChecker
     */
    protected $permissions;

    /**
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return JsonResponse
     */
    public function permissions()
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return response()->json([
            'permissions' => $permissions
        ]);
    }
}
