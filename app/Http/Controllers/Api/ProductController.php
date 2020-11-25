<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Repositories\ProductRepository;
use App\Http\Resources\Product\ProductResource;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends AppBaseController
{
    /** @var  productRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }
    /**
     * @OA\Get(
     *     path="/products",
     *     summary="Mostrar Productos",
     *     tags={"products"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de Productos. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $products = $this->productRepository->all();

        return $this->showAll(new ProductCollection($products));
    }

    /**
     * @OA\Post(
     *     path="/products",
     *     tags={"products"},
     *     operationId="store",
     *     summary="Agregar un nuevo Producto.",
     *     @OA\RequestBody(
     *         description="Producto a ser creado",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
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
    public function store(ProductRequest $request)
    {
        $campos = $request->validated();
        $products = $this->productRepository->create($campos);

        return $this->showOne(new ProductResource($products), 201);
    }

    /**
     * @OA\Get(
     *     path="/products/{productId}",
     *     summary="Buscar Producto por ID",
     *     description="Retorna un Producto",
     *     operationId="show",
     *     tags={"products"},
     *     @OA\Parameter(
     *         description="ID del Producto a retornar",
     *         in="path",
     *         name="productId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Producto no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Product $product)
    {
        return $this->showOne(new ProductResource($product), 200);
    }

    /**
     * @OA\Put(
     *     path="/products/{productId}",
     *     tags={"products"},
     *     operationId="update",
     *     summary="Actualizar un Producto existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Producto a ser actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Parameter(
     *         description="ID del Producto a actualizar",
     *         in="path",
     *         name="productId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Producto actualizada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(ProductRequest $request, Product $product)
    {
        $campos = $request->validated();

        $product = $this->productRepository->update($campos, $product);

        return $this->showOne(new ProductResource($product), 200);
    }

    /**
     * @OA\Delete(
     *     path="/products/{productId}",
     *     summary="Elimina un Producto",
     *     description="",
     *     operationId="delete",
     *     tags={"products"},
     *     @OA\Parameter(
     *         description="Id del Producto a eliminar",
     *         in="path",
     *         name="productId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Producto eliminado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->showOne(new ProductResource($product), 200);
    }
}
