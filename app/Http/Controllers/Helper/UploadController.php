<?php

namespace App\Http\Controllers\Helper;

use App\Helpers\WebStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * upload the image file from editor.
     *
     * @retparamurn \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function image(Request $request)
    {
        $this->validate($request, [
            'picture' => 'required|image|mimes:jpeg,jpg,bmp,png',
        ]);

        // upload logo_file
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            if (! $picture->isValid()) {
                return $this->apiShow(WebStatus::IMAGE_UPLOAD_FAILED_CODE, WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $picture_save_folder = config('custom.topic_pictures_save_path');
            $full_picture_path = upload_image($picture, $picture_save_folder, 670, 760);
            $image_url = ['image_url' => $full_picture_path];
            return $this->apiShow(WebStatus::IMAGE_UPLOAD_SUCCESS_CODE, WebStatus::IMAGE_UPLOAD_SUCCESS_MESSAGE, $image_url);
        }

        return $this->apiShow(WebStatus::NO_SELECT_IMAGE_CODE, WebStatus::NO_SELECT_IMAGE_MESSAGE);
    }
}
