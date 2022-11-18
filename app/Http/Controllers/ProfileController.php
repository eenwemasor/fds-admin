<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function list(Request $request)
    {
        $profiles =  Profile::paginate(10);

        return Response($profiles, 200);
    }

    public function view(Request $reques, $profileId)
    {
        $profile =  Profile::with('images')->find($profileId);

        if ($profile) {
            return Response($profile, 200);
        } else {
            return Response('Profile not found', 404);
        }
    }


    public function store(ProfileRequest $request)
    {
        $input  = $request->validated();
        $profile =  Profile::create([
            'name' => $input['name']
        ]);

        if ($profile) {
            return Response($profile, 200);
        } else {
            return Response('Failed to created profile', 400);
        }
    }

    public function uploadFiles(Request $request, $profileId)
    {
        $profile =  Profile::find($profileId);

        if ($profile) {
            $this->validate($request, [
                'file' => 'required|image|max:2048'
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = time() . $file->getClientOriginalName();
                $filePath =  $profile->name . '/' . $name;
                $file = Storage::disk('s3')->put($filePath, file_get_contents($file));
            }

            ProfileImage::create([
                'profile_id' => $profileId,
                'path' => Storage::disk('s3')->url($filePath),
                'name' => $name,
                'local_path' => $filePath
            ]);

            $profile->load('images');

            return Response($profile, 200);
        } else {
            return Response('Failed to created profile', 400);
        }
    }

    public function delete(ProfileRequest $request, $profileId)
    {
        $profile =  Profile::with('images')->find($profileId);


        if ($profile) {

            foreach ($profile->images as $image) {
                Storage::disk('s3')->delete($image->local_path);
            }

            $profile->delete();

            return Response($profile, 200);
        } else {
            return Response('Failed to delete image', 400);
        }
    }


    public function deleteImage(ProfileRequest $request, $profileId, $imageId)
    {
        $image =  ProfileImage::find($imageId);


        if ($image) {

            $deleteFile = Storage::disk('s3')->delete($image->local_path);

            if ($deleteFile) {
                $image->delete();

                return Response($image, 200);
            }
            return Response('Failed to delete image', 400);
        } else {
            return Response('Failed to delete image', 400);
        }
    }
}
