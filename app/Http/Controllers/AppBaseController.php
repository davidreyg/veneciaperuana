<?php

namespace App\Http\Controllers;

use Response;
use App\Http\Utils\ApiResponser;

/**
 * @OA\Info(
 *      version="1.0",
 *      title="Restobar Venecia Peruana",
 *      description="Sistema de restaurante en linea. Con control de inventario",
 *      @OA\Contact(
 *          email="neisserrey@upeu.edu.pe"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */
/**
 *  @OA\Server(
 *      url="http://veneciaperuana.dev.com/api/",
 *      description="Documentación del Restobar Venecia Peruana"
 *  )
 */
class AppBaseController extends Controller
{
    use ApiResponser;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        //esta en las rutas principales
        // $this->middleware(['auth.jwt']);
    }
}
