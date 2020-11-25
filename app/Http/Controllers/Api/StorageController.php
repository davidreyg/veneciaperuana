<?php

namespace App\Http\Controllers\Api;

use App\Models\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Repositories\StorageRepository;
use App\Http\Requests\StorageRequest;
use App\Http\Resources\Storage\StorageCollection;
use App\Http\Resources\Storage\StorageResource;

class StorageController extends AppBaseController
{
    /** @var  storageRepository */
    private $storageRepository;

    public function __construct(StorageRepository $storageRepository)
    {
        $this->storageRepository = $storageRepository;
    }
    /**
     * @OA\Get(
     *     path="/storages",
     *     summary="Mostrar Almacen de items",
     *     tags={"storages"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de Almacen de items. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $storages = $this->storageRepository->all();

        return $this->showAll(new StorageCollection($storages));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/storages/{storageCode}",
     *     summary="Buscar item en el Almacen por CODIGO",
     *     description="Retorna un item en el Almacen",
     *     operationId="show",
     *     tags={"storages"},
     *     @OA\Parameter(
     *         description="ID del item en el Almacen a retornar",
     *         in="path",
     *         name="storageCode",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Storage")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="item en el Almacen no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Storage $storage)
    {
        return $this->showOne(new StorageResource($storage), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorageRequest $request, Storage $storage)
    {
        $campos = $request->validated();

        $storage = $this->storageRepository->update($campos, $storage);

        return $this->showOne(new StorageResource($storage), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
