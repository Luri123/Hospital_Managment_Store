<?php

namespace App\Http\Controllers\api;

use App\Models\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;


/**
 * @OA\Schema(
 *     schema="Doctor",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="phone", type="string"),
 *     @OA\Property(property="speciality", type="string"),
 *     @OA\Property(property="room", type="string"),
 *     @OA\Property(property="imahe", type="string"),
 *     
 * )
 */

class AdminController extends Controller
{
    

/**
 * Upload doctor information and an image.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Post(
 *     path="/api/upload-doctor",
 *     operationId="uploadDoctor",
 *     tags={"Doctors"},
 *     summary="Upload doctor information and an image",
 *     description="Uploads doctor information and an image.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Doctor details and image",
 *         @OA\JsonContent(
 *             required={"name", "phone", "speciality", "room", "image"},
 *             @OA\Property(property="name", type="string", example="Dr. John Doe"),
 *             @OA\Property(property="phone", type="string", example="123-456-7890"),
 *             @OA\Property(property="speciality", type="string", example="Cardiologist"),
 *             @OA\Property(property="room", type="string", example="Room 101"),
 *             @OA\Property(property="image", type="string", format="binary", example="base64-encoded-image-data")
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctor added successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Doctor Added Successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     ),
 * )
 */
public function upload(Request $request)
{

    $doctor = new Doctor;
    $doctor->name = $request->name;
    $doctor->phone = $request->phone;
    $doctor->speciality = $request->speciality;
    $doctor->room = $request->room;
    $doctor->save();

    if ($request->hasFile('image')) {
        $imageName = time() . "." . $request->file('image')->extension();
        Storage::disk('public')->put(
            $imageName,
            file_get_contents($request->file('image')->getRealPath())
        );
        $doctor->image = $imageName;
        $doctor->save();
    }
    return response()->json(['message' => 'Doctor Added Successfully'], 200);
}




/**
 * Update doctor details.
 *
 * @OA\Post(
 *     path="/api/doctors/{id}",
 *     operationId="updateDoctor",
 *     tags={"Doctors"},
 *     summary="Update doctor details",
 *     description="Updates the details of a doctor.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Doctor ID",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Doctor details",
 *         @OA\JsonContent(
 *             required={"name", "phone", "speciality", "room", "image"},
 *             @OA\Property(property="name", type="string", example="Dr. John Doe"),
 *             @OA\Property(property="phone", type="string", example="123-456-7890"),
 *             @OA\Property(property="speciality", type="string", example="Cardiologist"),
 *             @OA\Property(property="room", type="string", example="Room 101"),
 *             @OA\Property(property="image", type="string", format="binary", example="base64-encoded-image-data"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctor details updated successfully",
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 * )
 */
public function updatedoctor(Request $request, $id)
{

    return response()->json(['message' => 'Doctor Details updated successfully']);
}


/**
 * Show a list of doctors.
 *
 * @return \Illuminate\View\View
 *
 * @OA\Get(
 *     path="/api/doctors",
 *     operationId="showDoctorList",
 *     tags={"Doctors"},
 *     summary="Show a list of doctors",
 *     description="Displays a list of doctors.",
 *     @OA\Response(
 *         response=200,
 *         description="View displaying a list of doctors",
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 * )
 */
public function showdoctor()
{
    $doctors = doctor::all();
    return response()->json($doctors);
}




/**
 * Delete a doctor.
 *
 *
 * @OA\Delete(
 *     path="/api/doctors/{id}",
 *     operationId="deleteDoctor",
 *     tags={"Doctors"},
 *     summary="Delete a doctor",
 *     description="Deletes a doctor by ID and redirects back.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Doctor ID",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *     ),
 *     @OA\Response(
 *         response=302,
 *         description="Redirects back after successful deletion",
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 * )
 */
public function deletedoctor($id)
{
    Doctor::destroy($id);
    return redirect()->back();
}




}
