<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class PersonController extends Controller
{

    public function index()
    {
        return Person::paginate();
    }

    public function create()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        $person = Person::firstOrCreate([
            'name' => $request->name,
            'surname' => $request->surname,
            'personal_code' => $request->personal_code,
            'type' => $request->type,
        ]);

        if ($person->wasRecentlyCreated) {
            return new JsonResponse([
                'message' => 'Successfully added person',
                'data' => new PersonResource($person),
            ], 201);
        } else {
            return new JsonResponse([
                'message' => 'A person with this personal code already exists',
                'data' => new PersonResource($person)
            ], 400);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $person = Person::findOrFail($id);
            return new JsonResponse([
                'data' => new PersonResource($person)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse([
                'message' => 'Person not found',
                'code' => $e->getCode()
            ], 404);
        }
    }

    public function edit(Person $person)
    {
        //
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $person = Person::findOrFail($id);
            $person->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'personal_code' => $request->personal_code,
                'type' => $request->type,
            ]);
            return new JsonResponse([
                'data' => new PersonResource($person)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse([
                'message' => 'Person not found',
                'code' => $e->getCode()
            ], 404);
        }
    }

    public function destroy(int $id)
    {
        try {
            $person = Person::findOrFail($id);
            $person->delete();
            return new JsonResponse([
                'message' => 'Successfully deleted person',
                'data' => new PersonResource($person)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse([
                'message' => 'Person not found',
                'code' => $e->getCode()
            ], 404);
        }
    }
}
