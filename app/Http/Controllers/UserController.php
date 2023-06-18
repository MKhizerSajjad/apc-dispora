<?php

namespace App\Http\Controllers;
// use Redirect;
use DB;
use Hash;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Countries;
// use Illuminate\Pagination\LengthAwarePaginator;
// use Illuminate\Pagination\Paginator;
// use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     Paginator::useBootstrapFive();
    //     // Paginator::useBootstrapFour();
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->user_type == 1) {
            $route = Route::current()->uri();
            $users = User::with('countries:id,name')->where('id', '!=', Auth::user()->id)->where('user_type', 2)->orderBy('first_name','DESC');

            if ($request->has('title') && $request->title != '') {
                $title = $request->title;
                $users = $users->where('title', $title);
            }
            
            if ($request->has('first_name') && $request->first_name != '') {
                $first_name = $request->first_name;
                $users = $users->where('first_name', 'LIKE', $first_name.'%');
            }
            
            if ($request->has('last_name') && $request->last_name != '') {
                $last_name = $request->last_name;
                $users = $users->where('last_name', 'LIKE', $last_name.'%');
            }
            
            if ($request->has('email') && $request->email != '') {
                $email = $request->email;
                $users = $users->where('email', 'LIKE', $email.'%');
            }
            
            if ($request->has('mobile_number') && $request->mobile_number != '') {
                $mobile_number = $request->mobile_number;
                $users = $users->where('mobile_number', 'LIKE', $mobile_number.'%');
            }
            
            if ($request->has('emergency_number') && $request->emergency_number != '') {
                $emergency_number = $request->emergency_number;
                $users = $users->where('emergency_number','LIKE', $emergency_number);
            }

            if ($request->has('date_of_birth') && $request->date_of_birth != '') {
                $date_of_birth = $request->date_of_birth;
                $users = $users->where('date_of_birth', $date_of_birth);
            }

            if ($request->has('registration_date') && $request->registration_date != '') {
                $registration_date = $request->registration_date;
                $users = $users->where('registration_date', $registration_date);
            }

            if ($request->has('occupation') && $request->occupation != '') {
                $occupation = $request->occupation;
                $users = $users->where('occupation', 'LIKE', '%'.$occupation.'%');
            }

            if ($request->has('party_position') && $request->party_position != '') {
                $party_position = $request->party_position;
                $users = $users->where('party_position', 'LIKE', $party_position.'%');
            }

            if ($request->has('branch') && $request->branch != '') {
                $branch = $request->branch;
                $users = $users->where('branch', 'LIKE', $branch.'%');
            }

            if ($request->has('membership_type') && $request->membership_type != '') {
                $membership_type = $request->membership_type;
                $users = $users->where('membership_type', $membership_type);
            }

            if ($request->has('status') && $request->status != '') {
                $status = $request->status;
                $users = $users->where('status', $status);
            }

            if ($request->has('volunteer') && $request->volunteer != '') {
                $volunteer = $request->volunteer;
                $users = $users->where('volunteer', $volunteer);
            }

            if ($request->has('address') && $request->address != '') {
                $address = $request->address;
                $users = $users->where('address', 'LIKE', '%'.$address.'%');
            }

            if ($request->has('city') && $request->city != '') {
                $city = $request->city;
                $users = $users->where('city', 'LIKE', '%'.$city.'%');
            }

            if ($request->has('state') && $request->state != '') {
                $state = $request->state;
                $users = $users->where('state', 'LIKE', '%'.$state.'%');
            }

            if ($request->has('zipcode') && $request->zipcode != '') {
                $zipcode = $request->zipcode;
                $users = $users->where('zipcode', 'LIKE', '%'.$zipcode.'%');
            }
            
            if ($request->has('country') && $request->country != '') {
                $country = $request->country;
                $users = $users->where('country', $country);
            }

            $data = $users->paginate(10);
            $countries = Countries::where('status', 'Active')->orderBy('name')->get();
            $filters = $request->all();

            return view('admin.users.index',compact('data', 'countries', 'filters'))
                ->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
            return redirect()->route('users.show', ['user' => Auth::user()->id]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $countries = Countries::where('status', 'Active')->orderBy('name')->get();
        return view('admin.users.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
            'title' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users',
            'mobile_number' => 'min:12|max:18|unique:users',
            'emergency_number' => 'required|min:10|max:18|unique:users',
            'date_of_birth' => 'required',
            'registration_date' => 'required',
            'occupation' => 'required',
            'party_position' => 'required',
            'branch' => 'required',
            'chapter' => 'required',
            'membership_type' => 'required',
            'status' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $data = $request->all();

        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/users');
            $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
            $picture = $request->picture;
            $extension = 'png';
            // $extension = $picture->getClientOriginalExtension();

            if(in_array($extension, $imageExt)) {
                // $name = preg_replace('/\s+/', '', $request->first_name);
                // $frontNewName = $name.'-'.$user->id.$extension;
                
                $uniqueIdentifier = uniqid();

                $data['picture'] = $image = $uniqueIdentifier.'.'.$extension;
                $picture->move($imageStorage, $image); // Move File
            }
        }
        
        $data['password'] = Hash::make($data['password']);
        unset($data['password_confirmation']);
        $user = User::create($data);

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (!empty($user)) {

            $countries = Countries::where('status', 'Active')->orderBy('name')->get();

            $data = [
                'user' => $user,
                'countries' => $countries
            ];
            return view('admin.users.show', compact('countries', 'user'));

        } else {
            return Redirect::to('user');
        }

    }
    // public function show(Request $request)
    // {
    //     $post = User::find($request->post)->first();
    //     $comments = User::with('user:id,name,avatar')->where('forum_post_id', $request->post)->get();
    //     // dd($post);
    //     return view('forum.post', compact('post', 'comments'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->user_type != 1 && Auth::user()->id != $user->id) {
            return redirect()->route('users.show', ['user' => Auth::user()->id]);
        }

        $countries = Countries::where('status', 'Active')->orderBy('name')->get();
        $user = User::find($user->id);
        return view('admin.users.edit',compact('user', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {       
        if(Auth::user()->user_type == 1) {
            $redirectionURL = "'users.index'";
            $this->validate($request, [
                'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
                'title' => 'required',
                'first_name' => 'required|regex:/^[\pL\s]+$/u',
                'last_name' => 'required|regex:/^[\pL\s]+$/u',
                'email' => 'required|email|max:255|unique:users,email,'.$user->id,
                'mobile_number' => 'min:12|max:18|unique:users,mobile_number,'.$user->id,
                'emergency_number' => 'required|min:10|max:18|unique:users,emergency_number,'.$user->id,
                'date_of_birth' => 'required',
                'registration_date' => 'required',
                'occupation' => 'required',
                'party_position' => 'required',
                'branch' => 'required',
                'chapter' => 'required',
                'membership_type' => 'required',
                'status' => 'required',
                'password' => 'nullable|string|min:8|confirmed',
            ]);
        } else {
            $redirectionURL = "'users.show', ['user' => Auth::user()->id]";
            $this->validate($request, [
                'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
                'mobile_number' => 'min:12|max:18|unique:users,mobile_number,'.$user->id,
                'emergency_number' => 'required|min:10|max:18|unique:users,emergency_number,'.$user->id,
                'occupation' => 'required',
                'password' => 'nullable|string|min:8|confirmed',
            ]);
        }
        
        $data = $request->all();
        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/users');
            $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
            $picture = $request->picture;
            $extension = 'png';
            // $extension = $picture->getClientOriginalExtension();

            if(in_array($extension, $imageExt)) {
                // $name = preg_replace('/\s+/', '', $request->first_name);
                // $frontNewName = $name.'-'.$user->id.$extension;
                
                $uniqueIdentifier = uniqid();

                $data['picture'] = $image = $uniqueIdentifier.'.'.$extension;
                $picture->move($imageStorage, $image); // Move File
            }
        }

        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }else{
            $data = Arr::except($data,array('password'));
            $data = Arr::except($data,array('password_confirmation'));
        }

        $user = User::find($user->id);
        $user->update($data);

        return redirect()->route($redirectionURL)->with('success','User updated successfully');
    }

    /**
     * Update password of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function pass(Request $request, User $user)
    {
        $pass = \Hash::make($request->password);

        dd($pass. '===' . $request->password);

        $data = [
            'password' => $pass
        ];

        $profileUpdate = User::where('id', $user->id)->update($data);

        if (isset($profileUpdate)) {
            return Redirect::to(route('users.show', ['user' => $user->id]))
            ->with('alert', "alert-primary")
            ->with('message', "Record updated successfully.");
        } else {
            return Redirect::to(route('users.show', ['user' => $user->id]))
            ->with('alert', "alert-danger")
            ->with('message', "Record isn't save.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // dd('aa');
        // $user->delete();
        // return redirect()->route('customers.index')->with('success','User deleted successfully');
    }
}
