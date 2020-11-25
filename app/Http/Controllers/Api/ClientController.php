<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Repositories\ClientRepository;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\Client\ClientCollection;
use App\Http\Resources\Client\ClientResource;

class ClientController extends AppBaseController
{
    /** @var  clientRepository */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepository = $clientRepo;
    }
    /**
     * @OA\Get(
     *     path="/clients",
     *     summary="Mostrar clientes",
     *     tags={"clients"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de clientes. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $clients = $this->clientRepository->all();

        return $this->showAll(new ClientCollection($clients));
    }

    /**
     * @OA\Post(
     *     path="/clients",
     *     tags={"clients"},
     *     operationId="store",
     *     summary="Agregar un nuevo Cliente.",
     *     @OA\RequestBody(
     *         description="Cliente a ser creado",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Client")
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
    public function store(ClientRequest $request)
    {
        $campos = $request->validated();
        $client = $this->clientRepository->create($campos);

        return $this->showOne(new ClientResource($client), 201);
    }

    /**
     * @OA\Get(
     *     path="/clients/{clientId}",
     *     summary="Buscar cliente por ID",
     *     description="Retorna un cliente",
     *     operationId="show",
     *     tags={"clients"},
     *     @OA\Parameter(
     *         description="ID del cliente a retornar",
     *         in="path",
     *         name="clientId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Client")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="cliente no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Client $client)
    {
        return $this->showOne(new ClientResource($client), 200);
    }

    /**
     * @OA\Put(
     *     path="/clients/{clientId}",
     *     tags={"clients"},
     *     operationId="update",
     *     summary="Actualizar un Cliente existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Cliente a ser actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Client")
     *     ),
     *     @OA\Parameter(
     *         description="ID del Cliente a actualizar",
     *         in="path",
     *         name="clientId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Cliente actualizada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(ClientRequest $request, Client $client)
    {
        $campos = $request->validated();

        $client = $this->clientRepository->update($campos, $client);

        return $this->showOne(new ClientResource($client), 200);
    }

    /**
     * @OA\Delete(
     *     path="/clients/{clientId}",
     *     summary="Elimina un cliente",
     *     description="",
     *     operationId="delete",
     *     tags={"clients"},
     *     @OA\Parameter(
     *         description="Id del cliente a eliminar",
     *         in="path",
     *         name="clientId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="cliente no encontrado",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="cliente eliminado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return $this->showOne(new ClientResource($client), 200);
    }
}
