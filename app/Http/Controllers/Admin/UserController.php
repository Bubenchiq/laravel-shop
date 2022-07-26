<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\Create;
use App\Http\Requests\Admin\Users\Update;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:users@index'])->only(['index']);
        $this->middleware(['permission:users@create'])->only(['create', 'store']);
        $this->middleware(['permission:users@show'])->only(['show']);
        $this->middleware(['permission:users@edit'])->only(['edit', 'update']);
        $this->middleware(['permission:users@delete'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        if($date = $request->get('date')) {
            $searchData['from'] = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
            $searchData['to'] = Carbon::createFromFormat('Y-m-d', $date)->endOfDay();
        }

        $users = User::query()
            ->with('roles')
            ->when($request->name, fn(Builder $builder) => $builder->where('name', 'like',"%$request->name%"))
            ->when($request->userId, fn(Builder $builder) => $builder->where('id', '=', $request->userId))
            ->when($request->roleName, fn(Builder $builder) => $builder->whereHas('roles', function(Builder $builder) use ($request) {
                $builder->where('name', 'like',"%$request->roleName%");
            }))
            ->when($request->roleId, fn(Builder $builder) => $builder->whereHas('roles', function(Builder $builder) use ($request) {
                $builder->where('id', $request->roleId);
            }))
            ->when($date, fn(Builder $builder) => $builder->where('created_at', '>=', $searchData['from'])->where('created_at', '<=', $searchData['to']))
            ->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availableRoles = Role::query()->where('name', '!=', 'admin')->pluck('name', 'id');
        return view('admin.users.create', compact('availableRoles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ])->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $availableRoles = Role::query()->where('name', '!=', 'admin')->pluck('name', 'id');
        return view('admin.users.update',compact('user', 'availableRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, User $user)
    {
        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => $user->syncRoles($request->get('role'))
        ]);

        return redirect()->route('admin.users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success','User deleted successfully');
    }

}
