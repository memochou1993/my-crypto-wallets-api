<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use App\Http\Requests\WalletUpdateRequest;
use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct() {
        $this->authorizeResource(Wallet::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     tags={"Wallet"},
     *     path="/api/wallets",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $wallets = $request->user()->wallets()->with(['chain'])->get();

        return WalletResource::collection($wallets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     tags={"Wallet"},
     *     path="/api/wallets",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", default=""),
     *                 @OA\Property(property="address", type="string", default=""),
     *                 @OA\Property(property="is_enabled", type="boolean", default=false),
     *                 @OA\Property(property="chain_id", type="integer", default=0),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Created", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response=403, description="Forbidden", @OA\JsonContent()),
     *     @OA\Response(response=404, description="Not Found", @OA\JsonContent()),
     *     @OA\Response(response=422, description="Unprocessable Content", @OA\JsonContent()),
     * )
     *
     * @param WalletStoreRequest $request
     * @return WalletResource
     */
    public function store(WalletStoreRequest $request)
    {
        $wallet = $request->user()->wallets()->create($request->all());

        return new WalletResource($wallet);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     tags={"Wallet"},
     *     path="/api/wallets/{id}",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="Wallet ID",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response=403, description="Forbidden", @OA\JsonContent()),
     *     @OA\Response(response=404, description="Not Found", @OA\JsonContent()),
     * )
     *
     * @param Wallet $wallet
     * @return WalletResource
     */
    public function show(Wallet $wallet)
    {
        return new WalletResource($wallet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *     tags={"Wallet"},
     *     path="/api/wallets/{id}",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="Wallet ID",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", default=""),
     *                 @OA\Property(property="address", type="string", default=""),
     *                 @OA\Property(property="is_enabled", type="boolean", default=false),
     *                 @OA\Property(property="chain_id", type="integer", default=0),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response=403, description="Forbidden", @OA\JsonContent()),
     *     @OA\Response(response=404, description="Not Found", @OA\JsonContent()),
     *     @OA\Response(response=422, description="Unprocessable Content", @OA\JsonContent()),
     * )
     *
     * @param WalletUpdateRequest $request
     * @param Wallet $wallet
     * @return WalletResource
     */
    public function update(WalletUpdateRequest $request, Wallet $wallet)
    {
        $wallet->update($request->all());

        return new WalletResource($wallet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     tags={"Wallet"},
     *     path="/api/wallets/{id}",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="Wallet ID",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=204, description="No Content", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response=403, description="Forbidden", @OA\JsonContent()),
     *     @OA\Response(response=404, description="Not Found", @OA\JsonContent()),
     * )
     *
     * @param Wallet $wallet
     * @return JsonResponse
     */
    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
