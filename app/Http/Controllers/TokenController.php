<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenStoreRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     tags={"Token"},
     *     path="/api/tokens",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="email", type="string", default=""),
     *                 @OA\Property(property="password", type="string", default=""),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response=422, description="Unprocessable Content", @OA\JsonContent()),
     * )
     *
     * @param TokenStoreRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function store(TokenStoreRequest $request)
    {
        /** @var User $user */
        $user = User::query()->firstWhere('email', $request->input('email'));

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw new AuthenticationException();
        }

        $token = $user->createToken('')->plainTextToken;

        return response()->json([
            'data' => [
                'token' => $token,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     tags={"Token"},
     *     path="/api/tokens",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=204, description="No Content", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
