<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Repositories\CategoryRepository;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Category\CategoryCollection;

class CategoryController extends AppBaseController
{
    /** @var  categoryCategory */
    private $categoryCategory;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }
    /**
     * @OA\Get(
     *     path="/categories",
     *     summary="Mostrar Categorias de productos",
     *     tags={"categories"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de Categorias de productos. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return $this->showAll(new CategoryCollection($categories));
    }

    /**
     * @OA\Post(
     *     path="/categories",
     *     tags={"categories"},
     *     operationId="store",
     *     summary="Agregar un nuevo Categorias de productos.",
     *     @OA\RequestBody(
     *         description="Categorias de productos a ser creado",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Category")
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
    public function store(CategoryRequest $request)
    {
        $campos = $request->validated();
        $category = $this->categoryRepository->create($campos);

        return $this->showOne(new CategoryResource($category), 201);
    }

    /**
     * @OA\Get(
     *     path="/categories/{categoryID}",
     *     summary="Buscar Categorias de productos por ID",
     *     description="Retorna un Categorias de productos",
     *     operationId="show",
     *     tags={"categories"},
     *     @OA\Parameter(
     *         description="ID del Categorias de productos a retornar",
     *         in="path",
     *         name="categoryID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Categorias de productos no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Category $category)
    {
        return $this->showOne(new CategoryResource($category), 200);
    }

    /**
     * @OA\Put(
     *     path="/categories/{categoryId}",
     *     tags={"categories"},
     *     operationId="update",
     *     summary="Actualizar una Categorias de productos existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Categorias de productos a ser actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Parameter(
     *         description="ID del Categorias de productos a actualizar",
     *         in="path",
     *         name="categoryId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categorias de productos no encontrado",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Categorias de productos actualizado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $campos = $request->validated();

        $category = $this->categoryRepository->update($campos, $category);

        return $this->showOne(new CategoryResource($category), 200);
    }

    /**
     * @OA\Delete(
     *     path="/categories/{categoryId}",
     *     summary="Elimina un Categorias de productos",
     *     description="",
     *     operationId="delete",
     *     tags={"categories"},
     *     @OA\Parameter(
     *         description="Id del Categorias de productos a eliminar",
     *         in="path",
     *         name="categoryId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categorias de productos no encontrado",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Categorias de productos eliminado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne(new CategoryResource($category), 200);
    }
}
