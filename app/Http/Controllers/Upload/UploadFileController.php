<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function uploadKomentar(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        // Save file to admin_usmhub
        $path = $request->file('file')->store('file_komentar', 'public');

        // Optionally, save file to api_usmhub
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $destinationPath = storage_path('app/public/api_usmhub/file_komentar');
        $file->move($destinationPath, $fileName);

        return response()->json(['path' => $path], 200);
    }

    public function uploadAduan(Request $request)
    {
        $request->validate([
            'bukti_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pathAdun = $request->file('bukti_photo')->store('photos', 'public');

        $photoAduan = $request->file('bukti_photo');
        $fileName = $photoAduan->getClientOriginalName();
        $destinationPhoto = storage_path('app/public/api_usmhub/photos');
        $photoAduan->move($destinationPhoto, $fileName);

        return response()->json(['path' => $pathAdun], 200);
    }

    public function uploadUser(Request $request)
    {
        $request->validate([
            'img_profile' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Save file to api_usmhub
        $ppUser = $request->file('img_profile')->store('photos', 'public');

        // Optionally, save file to admin_usmhub
        $file = $request->file('img_profile');
        $fileName = $file->getClientOriginalName();
        $destinationPath = storage_path('app/public/api_usmhub/photos');
        $file->move($destinationPath, $fileName);

        return response()->json(['path' => $ppUser], 200);
    }
}
