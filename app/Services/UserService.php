<?php
namespace App\Services;
use Location;
use Exception;
use App\Models\User;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserService{

    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {

        if (array_key_exists('image', $data)){
            $image_path = uploadImage($data['image'], 'users');
            $data['image'] = $image_path;
        }
        $password = bin2hex(random_bytes(8));
        $data['password'] = bcrypt($password);

        $user = User::create($data);
        $data = [
            'name' => $user['name'],
            'email' => $user['email'],
            'link' => url('/'),
            'password' => $password,
        ];
        $mail = dispatch(new SendWelcomeEmailJob($data));
        // Return user object
        return $user;
    }

    public function destroy($id){

        $user = User::select('id')
        ->where('id', $id)
        ->withCount(['rateActions','actions','AssessmentManager','rates'])
        ->first();
        $user_array = $user->toArray();
        unset($user_array['id'],$user_array['image_path']);

        if (max(array_values($user_array))) {
            return $user_array;
        }
        $user->delete();

    }



    public function update_image($request)
    {

        $user = User::find($request->id);
        $oldImage = $user->image;
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:2048',
        ], [
            'image.required' => 'Please select an image to upload.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The file may not be greater than 2 MB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = storage_path('app/public/users/' . $filename);
            Image::make($image)->fit(300, 300)->save($path);
            $user->image = $filename;
            $user->save();
            if ($oldImage) {
                Storage::delete('public/users/' . $oldImage);
            }

            return $user;
        }
    }

    public function getQuarterlyAverageRates($userId, $startDate, $endDate) {
        $averageRates = DB::table('rates')
            ->join('assessments', 'rates.assessment_id', '=', 'assessments.id')
            ->select('assessments.slug', DB::raw('AVG(rate) as average_rate'))
            ->where('rates.user_id', $userId)
            ->where('rates.status', 'published')
            ->whereBetween('rates.date', [$startDate, $endDate])
            ->groupBy('assessments.slug')
            ->get();
        return $averageRates;
    }

}