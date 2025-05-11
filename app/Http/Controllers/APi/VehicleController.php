<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends BaseController
{

    public function index(): JsonResponse
    {
        $vehicles = Vehicle::all();
        return $this->sendResponse($vehicles, 'Vehicles retrieved successfully');
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'brannd' => 'required',
            'plate_number' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validaton Error', $validator->errors());
        }
        $vehicle = Vehicle::create($input);
        return $this->sendResponse($vehicle, 'Vehicle created successfully');
    }

    public function show($id): JsonResponse
    {
        $vehicle = Vehicle::find($id);

        if (is_null($vehicle)) {
            return $this->sendError('Vehicle not found');
        }

        return $this->sendResponse($vehicle, 'Vehicle retrieved successfully');
    }

    public function update(Request $request, $id): JsonResponse
    {
        $vehicle = Vehicle::find($id);

        if (is_null($vehicle)) {
            return $this->sendError('Vehicle not found');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'brannd' => 'required',
            'plate_number' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $vehicle->update($input);
        return $this->sendResponse($vehicle, 'Vehicle updated successfully');
    }

    public function destroy($id): JsonResponse
    {
        $vehicle = Vehicle::find($id);

        if (is_null($vehicle)) {
            return $this->sendError('Vehicle not found');
        }

        $vehicle->delete();
        return $this->sendResponse([], 'Vehicle deleted successfully');
    }

}
