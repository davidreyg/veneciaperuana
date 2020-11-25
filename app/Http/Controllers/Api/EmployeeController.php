<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Repositories\EmployeeRepository;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Employee\EmployeeCollection;

class EmployeeController extends AppBaseController
{
    /** @var  EmployeeRepository */
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepository = $employeeRepo;
    }
    /**
     * @OA\Get(
     *     path="/employees",
     *     summary="Mostrar Empleados",
     *     tags={"employees"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de Empleados. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $employees = $this->employeeRepository->all();

        return $this->showAll(new EmployeeCollection($employees));
    }

    /**
     * @OA\Post(
     *     path="/employees",
     *     tags={"employees"},
     *     operationId="store",
     *     summary="Agregar un nuevo Empleado.",
     *     @OA\RequestBody(
     *         description="Empleado a ser creado",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Employee")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Creado",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function store(EmployeeRequest $request)
    {
        $campos = $request->validated();
        $employee = $this->employeeRepository->create($campos);

        return $this->showOne(new EmployeeResource($employee), 201);
    }

    /**
     * @OA\Get(
     *     path="/employees/{employeeId}",
     *     summary="Buscar Empleado por ID",
     *     description="Retorna un Empleado",
     *     operationId="show",
     *     tags={"employees"},
     *     @OA\Parameter(
     *         description="ID del Empleado a retornar",
     *         in="path",
     *         name="employeeId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Employee")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Empleado no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Employee $employee)
    {
        return $this->showOne(new EmployeeResource($employee), 200);
    }

    /**
     * @OA\Put(
     *     path="/employees/{employeeId}",
     *     tags={"employees"},
     *     operationId="update",
     *     summary="Actualizar un Empleado existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Empleado a ser actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Employee")
     *     ),
     *     @OA\Parameter(
     *         description="ID del Empleado a actualizar",
     *         in="path",
     *         name="employeeId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Empleado no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Empleado actualizada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $campos = $request->validated();

        $employee = $this->employeeRepository->update($campos, $employee);

        return $this->showOne(new EmployeeResource($employee), 200);
    }

    /**
     * @OA\Delete(
     *     path="/employees/{employeeId}",
     *     summary="Elimina un Empleado",
     *     description="",
     *     operationId="delete",
     *     tags={"employees"},
     *     @OA\Parameter(
     *         description="Id del Empleado a eliminar",
     *         in="path",
     *         name="employeeId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Empleado no encontrado",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Empleado eliminado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return $this->showOne(new EmployeeResource($employee), 200);
    }
}
