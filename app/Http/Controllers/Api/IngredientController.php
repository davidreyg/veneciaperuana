<?php

namespace App\Http\Controllers\Api;

use App\Models\Ingredient;
use App\Http\Requests\IngredientRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Repositories\IngredientRepository;
use App\Http\Resources\Ingredient\IngredientResource;
use App\Http\Resources\Ingredient\IngredientCollection;

class IngredientController extends AppBaseController
{
    /** @var  ingredientRepository */
    private $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepo)
    {
        $this->ingredientRepository = $ingredientRepo;
    }
    /**
     * @OA\Get(
     *     path="/ingredients",
     *     summary="Mostrar Ingredientes",
     *     tags={"ingredients"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de Ingredientes. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $ingredients = $this->ingredientRepository->all();

        return $this->showAll(new IngredientCollection($ingredients));
    }

    /**
     * @OA\Post(
     *     path="/ingredients",
     *     tags={"ingredients"},
     *     operationId="store",
     *     summary="Agregar un nuevo Ingrediente.",
     *     @OA\RequestBody(
     *         description="Ingrediente a ser creado",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Ingredient")
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
    public function store(IngredientRequest $request)
    {
        $campos = $request->validated();
        $ingredient = $this->ingredientRepository->create($campos);

        return $this->showOne(new IngredientResource($ingredient), 201);
    }

    /**
     * @OA\Get(
     *     path="/ingredients/{ingredientId}",
     *     summary="Buscar Ingrediente por ID",
     *     description="Retorna un Ingrediente",
     *     operationId="show",
     *     tags={"ingredients"},
     *     @OA\Parameter(
     *         description="ID del Ingrediente a retornar",
     *         in="path",
     *         name="ingredientId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Ingredient")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Ingrediente no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Ingredient $ingredient)
    {
        return $this->showOne(new IngredientResource($ingredient), 200);
    }


    /**
     * @OA\Put(
     *     path="/ingredients/{ingredientId}",
     *     tags={"ingredients"},
     *     operationId="update",
     *     summary="Actualizar un Ingredient existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Ingredient a ser actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Ingredient")
     *     ),
     *     @OA\Parameter(
     *         description="ID del Ingredient a actualizar",
     *         in="path",
     *         name="ingredientId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ingredient no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ingredient actualizada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(IngredientRequest $request, Ingredient $ingredient)
    {
        $campos = $request->validated();

        $ingredient = $this->ingredientRepository->update($campos, $ingredient);

        return $this->showOne(new IngredientResource($ingredient), 200);
    }

    /**
     * @OA\Delete(
     *     path="/ingredients/{ingredientId}",
     *     summary="Elimina un Ingrediente",
     *     description="",
     *     operationId="delete",
     *     tags={"ingredients"},
     *     @OA\Parameter(
     *         description="Id del Ingrediente a eliminar",
     *         in="path",
     *         name="ingredientId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ingrediente no encontrado",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ingrediente eliminado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return $this->showOne(new IngredientResource($ingredient), 200);
    }
}
