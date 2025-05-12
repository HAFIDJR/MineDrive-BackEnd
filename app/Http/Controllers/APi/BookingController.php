<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends BaseController
{
    public function storeBooking(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = $request->user()->id;
        $input['start_time'] = date('Y-m-d H:i:s', strtotime($request->input('start_time')));
        $input['end_time'] = date('Y-m-d H:i:s', strtotime($request->input('end_time')));
        $validator = Validator::make($input, [
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'purpose' => 'required|string',
            'driver_id' => 'required|exists:users,id',
            'approver_level1_id' => 'required|exists:users,id',
            'approver_level2_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('Validation Error', $validator->errors());
        }
        $booking = Booking::create($input);
        return $this->sendResponse($booking, 'Booking created successfully');

    }
    public function getBookings(): JsonResponse
    {
        $bookings = Booking::with(['user', 'vehicle', 'driver'])->get();
        return $this->sendResponse($bookings, 'Bookings retrieved successfully');
    }

    public function showBooking($id): JsonResponse
    {
        $booking = Booking::with(['user', 'vehicle', 'driver'])->find($id);

        if (is_null($booking)) {
            return $this->sendError('Booking not found');
        }

        return $this->sendResponse($booking, 'Booking retrieved successfully');
    }

    public function updateBooking(Request $request, $id): JsonResponse
    {
        $booking = Booking::find($id);

        if (is_null($booking)) {
            return $this->sendError('Booking not found');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'purpose' => 'required|string',
            'driver_id' => 'nullable|exists:users,id',
            'approver_level1_id' => 'nullable|exists:users,id',
            'approver_level2_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $booking->update($input);
        return $this->sendResponse($booking, 'Booking updated successfully');
    }

    public function deleteBooking($id): JsonResponse
    {
        $booking = Booking::find($id);

        if (is_null($booking)) {
            return $this->sendError('Booking not found');
        }

        $booking->delete();
        return $this->sendResponse([], 'Booking deleted successfully');
    }



}
