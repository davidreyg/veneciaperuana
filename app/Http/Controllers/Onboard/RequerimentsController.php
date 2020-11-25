<?php

namespace App\Http\Controllers\Onboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Configuration\RequirementsChecker;

class RequerimentsController extends Controller
{
    /**
     * @var RequirementsChecker
     */
    protected $requirements;

    /**
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     *
     * @return JsonResponse
     */
    public function requirements()
    {
        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('installer.core.minPhpVersion')
        );
        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        return response()->json([
            'phpSupportInfo' => $phpSupportInfo,
            'requirements' => $requirements
        ]);
    }
}
