<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Hospital Managment",
 *     description="Hospital Managment Api Documentation")
 *
 * @OA\Schema(
 *     schema="Appointment",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="email", type="string"),
 *     @OA\Property(property="date", type="string"),
 *     @OA\Property(property="doctor", type="string"),
 *     @OA\Property(property="phone", type="string"),
 *     @OA\Property(property="message", type="string"),
 *     @OA\Property(property="status", type="string"),
 *     @OA\Property(property="user_id", type="string"),
 *     
 * )
 */


class HomeController extends Controller
{

    /**
     * Create a new appointment.
     *
     *
     * @OA\Post(
     *     path="/api/appointments",
     *     operationId="createAppointment",
     *     tags={"Appointments"},
     *     summary="Create a new appointment",
     *     description="Creates a new appointment based on user input.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Appointment details",
     *         @OA\JsonContent(
     *             required={"id","name", "email", "date", "doctor", "phone", "message","status"},
     *             @OA\Property(property="id", type="int",example="1"),
     *             @OA\Property(property="name", type="string",example="Adhurim"),
     *             @OA\Property(property="email", type="string",example="adhurim.quku34@gmail.com"),
     *             @OA\Property(property="date", type="string", format="date",example="23.04.2023"),
     *             @OA\Property(property="doctor", type="string",example="isuf"),
     *             @OA\Property(property="phone", type="string",example="0692935570"),
     *             @OA\Property(property="message", type="string",example="hello"),
     *             @OA\Property(property="status", type="string",example="In progress..."),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Appointment created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Appointment Request Successful. We will contact you soon..."),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     * )
     */
    public function appointment(Request $request)
    {
        $data = new Appointment();
    
        $data->name = $request->name;
        $data->email = $request->email;
        $data->date = $request->date;
        $data->doctor = $request->doctor;
        $data->phone = $request->phone;
        $data->message = $request->message;
        $data->status = 'In progress...';
        if (Auth::id()) {
            $data->user_id = Auth::user()->id;
        }
        $data->save();
    
    
        return redirect()->back()->with('message','Appointment Request Successful. We will contact you soon...');
    }
    


/**
 * Get a list of user's appointments.
 *
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\JsonResponse
 *
 * @OA\Get(
 *     path="/api/my-appointments",
 *     operationId="getUserAppointments",
 *     tags={"Appointments"},
 *     summary="Get a list of user's appointments",
 *     description="Returns a list of appointments for the authenticated user.",
 *     @OA\Response(
 *         response=200,
 *         description="A list of user's appointments",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Appointment")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     ),
 * )
 */
public function myappointment()
{
    if (Auth::user() && Auth::user()->usertype == '0') {
        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $appointments = Appointment::where('user_id', $user_id)->get();

            // Check if the request accepts JSON, and return JSON data if true
            if (request()->expectsJson()) {
                return response()->json(['appointments' => $appointments], 200);
            }

            return view('user.my_appointment', compact('appointments'));
        } else {
            return response()->json(['message' => 'User ID not found.'], 401);
        }
    } else {
        return response()->json(['message' => 'Unauthorized.'], 401);
    }
}





/**
 * Cancel an appointment.
 *
 * @param int $id
 *
 * @OA\Delete(
 *     path="/api/appointments/{id}",
 *     operationId="cancelAppointment",
 *     tags={"Appointments"},
 *     summary="Cancel an appointment",
 *     description="Cancels an appointment based on the provided ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the appointment to cancel.",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No content (successful deletion)"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found"
 *     )
 * )
 */
public function cancel($id)
{
    $appointment = Appointment::find($id);

    if (!$appointment) {
        return response()->json(['message' => 'Appointment not found.'], 404);
    }

    $appointment->delete();

    return response()->json(null, 204);
}




 
}
