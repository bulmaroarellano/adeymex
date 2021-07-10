<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', User::class);

        $pageConfigs = ['sidebarCollapsed' => false];
        $search = $request->get('search', '');

        $users = User::search($search)
            ->latest()->get();

  
  
  
        $breadcrumbs = [
            ['link'=>"javascript:void(0)",'name'=>"Administración"],['link'=>"users",'name'=>"Usuarios"]
        ];
        return view('paqueteria.users.index', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'users'=> $users, "search" => $search]);
         }
    

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Responses
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        $roles = Role::get();

        return view('paqueteria.users.create', compact('roles'));
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->syncRoles($request->roles);

        $search = $request->get('search', '');

        $users = User::search($search)
            ->latest()->get();
        return view('paqueteria.users.index', compact('users', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $this->authorize('view', $user);

        return view('paqueteria.users.show', compact('user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::get();

        return view('paqueteria.users.edit', compact('user', 'roles'));
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function getUserList(Request $request)
{
    
    $data  = User::get();
    return Datatables::of($data)
            ->addColumn('roles', function($data){
                $roles = $data->getRoleNames()->toArray();
                $badge = '';
                if($roles){
                    $badge = implode(' , ', $roles);
                }
                return $badge;
            })
            ->addColumn('permissions', function($data){
                $roles = $data->getAllPermissions();
                $badges = '';
                foreach ($roles as $key => $role) {
                    $badges .= '<span class="badge badge-dark m-1">'.$role->name.'</span>';
                }
                return $badges;
            })
            ->addColumn('action', function($data){
                if($data->name == 'Super Admin'){
                    return '';
                }
                if (Auth::user()->can('manage_user')){
                    return '<div class="table-actions">
                            <a href="'.url('user/'.$data->id).'" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                            <a href="'.url('user/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                        </div>';
                }else{
                    return '';
                }
            })
            ->rawColumns(['roles','permissions','action'])
            ->make(true);
}
}
