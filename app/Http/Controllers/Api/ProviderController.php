<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Repositories\ProviderRepository;
use App\Http\Requests\ProviderRequest;
use App\Http\Resources\Provider\ProviderCollection;
use App\Http\Resources\Provider\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends AppBaseController
{
    /** @var  providerRepository */
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
    }
    /**
     * @OA\Get(
     *     path="/providers",
     *     summary="Mostrar Proveedores",
     *     tags={"providers"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de Proveedores. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $providers = $this->providerRepository->all();

        return $this->showAll(new ProviderCollection($providers));
    }

    /**
     * @OA\Post(
     *     path="/providers",
     *     tags={"providers"},
     *     operationId="store",
     *     summary="Agregar un nuevo Proveedor.",
     *     @OA\RequestBody(
     *         description="Proveedor a ser creado",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Provider")
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
    public function store(ProviderRequest $request)
    {
        $campos = $request->validated();
        $provider = $this->providerRepository->create($campos);

        return $this->showOne(new ProviderResource($provider), 201);
    }

    /**
     * @OA\Get(
     *     path="/providers/{providerId}",
     *     summary="Buscar Proveedor por ID",
     *     description="Retorna un Proveedor",
     *     operationId="show",
     *     tags={"providers"},
     *     @OA\Parameter(
     *         description="ID del Proveedor a retornar",
     *         in="path",
     *         name="providerId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Provider")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Proveedor no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Provider $provider)
    {
        return $this->showOne(new ProviderResource($provider), 200);
    }

    /**
     * @OA\Put(
     *     path="/providers/{providerId}",
     *     tags={"providers"},
     *     operationId="update",
     *     summary="Actualizar un Proveedor existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Proveedor a ser actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Provider")
     *     ),
     *     @OA\Parameter(
     *         description="ID del Proveedor a actualizar",
     *         in="path",
     *         name="providerId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Proveedor no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Proveedor actualizada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        $campos = $request->validated();

        $provider = $this->providerRepository->update($campos, $provider);

        return $this->showOne(new ProviderResource($provider), 200);
    }

    /**
     * @OA\Delete(
     *     path="/providers/{providerId}",
     *     summary="Elimina un Proveedor",
     *     description="",
     *     operationId="delete",
     *     tags={"providers"},
     *     @OA\Parameter(
     *         description="Id del Proveedor a eliminar",
     *         in="path",
     *         name="providerId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Proveedor no encontrado",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Proveedor eliminado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return $this->showOne(new ProviderResource($provider), 200);
    }
}
