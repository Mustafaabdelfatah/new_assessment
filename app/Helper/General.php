<?php


use App\Models\User;
use Jenssegers\Date\Date;
use App\Jobs\SendUserEmailJob;
use App\Notifications\UserNotify;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadImage')) {
    function uploadImage($image, $path, $thumbnail = false)
    {
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image = Image::make($image);
        if ($thumbnail) {
            $image->fit(200, 200);
            $thumbnail_path = $path . '/thumbnails';
            Storage::disk('public')->makeDirectory($thumbnail_path);
            $thumbnail_path = $thumbnail_path . '/' . $filename;
            $image->save(storage_path('app/public/' . $thumbnail_path));
        }

        $image_path = $path . '/' . $filename;
        Storage::disk('public')->makeDirectory($path);
        $image->save(storage_path('app/public/' . $image_path));

        return $filename;
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date): string
    {
        return !is_numeric($date)
            ? Jenssegers\Date\Date::parse($date)->format('j F Y')
            : '---';
    }
}


if (!function_exists('sendMailFormat')) {
    function sendMsgFormat($assess=null,$type = 'email',$old_manager = null,$get_user=null,$action = null,$return = null,$url = null)
    {
        // dd($get_user);
        if($action == 'action'){
            if($type == 'email'){
                $data = [
                    'name'  => $get_user->name,
                    'title' => 'Action',
                    'link'  => $url,
                    'msg'   => $return,
                    'email' =>  $get_user->email,
                 ];
                dispatch(new SendUserEmailJob($data));
            }else{
                $data = [
                    'title' => 'Action',
                    'link' => $url,
                    'msg' => $return,
                    'type' => 'Action',
                    ];
                $get_user->notify(new UserNotify($data));
            }

        }else{
            if($type == 'email'){
                $data = [
                    'name'  => $assess->manager->name,
                    'title' => $assess->title,
                    'link'  => $url,
                    'msg'   => $return,
                    'email' =>  $assess->manager->email,
                ];
               return dispatch(new SendUserEmailJob($data));
            }else{
                $data = [
                    'title' => $old_manager != null ? 'Go Out' : $assess->title,
                    'link' => $old_manager != null ? '' : $url,
                    'msg' => $old_manager != null ?'You Go Out From Leading Assessment'.$assess->title :$return,
                    'type' => 'Assessment',
                    ];
                    $user_id = $old_manager != null ? $old_manager :$assess->manager->id;
                    $user = User::find($user_id);
                    return  $user->notify(new UserNotify($data));
            }
        }


    }
}
