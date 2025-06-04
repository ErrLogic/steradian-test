<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    use ApiResponseTrait;

    public function getCars(): JsonResponse
    {
        $cars = Car::simplePaginate(15);

        return $this->successResponse($cars, 'Cars retrieved successfully.', 200);
    }

    public function createCar(CarRequest $request): JsonResponse
    {
        $car = Car::create($request->validated());

        return $this->successResponse($car, 'Car created successfully.', 200);
    }

    public function getCarById(int $id): JsonResponse
    {
        $car = Car::find($id);

        return $this->successResponse($car, 'Car retrieved successfully.', 200);
    }

    public function updateCar(int $id, CarRequest $request): JsonResponse
    {
        $data = $request->validated();
        $car = Car::find($id);
        $car->update($data);

        return $this->successResponse($car, 'Car updated successfully.', 200);
    }

    public function deleteCar(int $id): JsonResponse
    {
        $car = Car::find($id);
        $car->delete();

        return $this->successResponse($car, 'Car deleted successfully.', 200);
    }
}
