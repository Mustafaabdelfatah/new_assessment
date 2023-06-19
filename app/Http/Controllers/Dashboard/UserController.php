<?php

namespace App\Http\Controllers\Dashboard;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Enums\UsersTypesEnums;
use App\Jobs\SendWelcomeEmailJob;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Services\PositionTreeService;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    // Property For UserService
    protected $userService;

     /**
     * @return Application|Factory|Construct
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Application|Factory|View
    */
    public function index()
    {
        return view('dashboard.pages.users.index', [
            'users' => User::with('position')
            ->where('type', '!=', UsersTypesEnums::ADMIN)
            ->orderBy('id','desc')
            ->get(),
            'positions' => Position::select('id','title')->get()
        ]);
    }

     /**
     * @param id $id
     * @return Application|Factory|View
     */
    public function getUser($id)
    {
        $user = User::findOrFail($id);
        $positions = Position::get();
        return view('dashboard.pages.users.edit',compact('user' , 'positions'));
    }


    /**
     * @param UserRequest $request
     * @return Application|Factory|View
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $user = $this->userService->store($validatedData);
        $type = $user->getRawOriginal('type');
        if ($type != 'admin') {
            return view('dashboard.pages.users.render', [
                'user' => $user,
                'create' => true,
                'isAdmin' => false
            ]);
        }
        return view('dashboard.pages.users.render', [
            'user' => $user,
            'create' => true,
            'isAdmin' => true
        ]);
    }

    /**
     * @param UserRequest $request
     * @param User $User
     * @return Application|Factory|View
     */
    public function update(UserRequest $request, User $user)
    {

        $user->update($request->validated());
        $type = $user->getRawOriginal('type');
        if ($type != 'admin') {
            return view('dashboard.pages.users.render', [
                'user' => $user,
                'create' => false,
                'isAdmin' => false
            ]);
        }
        return view('dashboard.pages.users.render', [
            'user' => $user,
            'create' => false,
            'isAdmin' => true
        ]);

    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $user = $this->userService->destroy($id);

        if ($user) {
            return response()->json([
                'message' => trans('Unable To Delete This user Because It BelongsTo Another Modules'),
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }


    public function show_user($id)
    {
        $firstQuarter = $this->userService->getQuarterlyAverageRates($id, Carbon::parse('January 1')->startOfQuarter(), Carbon::parse('March 31')->endOfQuarter());
        $secondQuarter = $this->userService->getQuarterlyAverageRates($id, Carbon::parse('April 1')->startOfQuarter(), Carbon::parse('June 30')->endOfQuarter());
        $thirdQuarter = $this->userService->getQuarterlyAverageRates($id, Carbon::parse('July 1')->startOfQuarter(), Carbon::parse('September 30')->endOfQuarter());
        $lastQuarter = $this->userService->getQuarterlyAverageRates($id, Carbon::parse('October 1')->startOfQuarter(), Carbon::parse('December 31')->endOfQuarter());
        $user = User::with('assessment')->whereNot('type', UsersTypesEnums::ADMIN)->find($id);
        return view('dashboard.pages.users.show-user', get_defined_vars());
    }


    public function update_user_image(Request $request){
        $user = $this->userService->update_image($request);
         // dd($user);
         if (isset($user->image)) {
             return response()->json(['image' => asset('storage/users/' . $user->image)]);
         } else {
             return response()->json(['errors' => 'Failed to update image']);
         }
     }


     public function show_users(Request $request)
     {
        $user_id = auth()->user()->id;
        $get_position = auth()->user()->position;
        $position = Position::orderBy('parent_id', 'asc')->get();
        if (auth()->user()->position == null) {
            $get_users = User::select(['id','name','image'])->whereNot('type',UsersTypesEnums::ADMIN)->skip($request->current_users_count)->take(5)->get();
        } else {
            $treeRepoIds = PositionTreeService::make($position, $get_position->id);
            $get_users = User::whereIn('position_id', $treeRepoIds['ids'])->skip($request->current_users_count)->take(5)->get();
        }
        $view = view('layout.partials._sidebar_user_element',compact('get_users'))->render();
        return response()->json(['users' => $view]);
    }

}
