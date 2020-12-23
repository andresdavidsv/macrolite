<?php

namespace App\Http\Controllers;

use App\User;
use App\Sortable;
use App\UserFilter;
use Illuminate\Http\Request;
use App\Http\Requests\SaveUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, UserFilter $filters, Sortable $sortable)
    {
        $users = User::query()
            ->filterBy($filters, $request->only(['search', 'from', 'to', 'order']))
            ->orderBy('id')
            ->paginate();

        $users->appends($filters->valid());

        $sortable->appends($filters->valid());

        return view('partial.user.index', [
            'view' => 'index',
            'users' => $users,
            'title' => 'Listado de Usuarios',
            'sortable' => $sortable,

        ])->with($this->formsData());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partial.user.create',[
            'user' => new User
        ])->with($this->formsData());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $request)
    {
        $request->createUser($request);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view ('partial.user.show',[
            'user'=> $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // $this->authorize('update',$user);

        return view ('partial.user.edit',[
            'user'=> $user
        ])->with($this->formsData());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(SaveUserRequest $request,User $user)
    {  
        // $this->authorize('update',$user);

        $request->updateUser($user,$request);
    
        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed(Request $request, UserFilter $filters, Sortable $sortable)
    {
        $users = User::onlyTrashed()
            ->filterBy($filters, $request->only(['search','from', 'to', 'order']))
            ->orderBy('id')
            ->paginate();

        $users->appends($filters->valid());

        $sortable->appends($filters->valid());

        return view('partial.user.index', [
            'view' => 'trash',
            'users' => $users,
            'title' => 'Listado de Condcutores en Papelera',
            'sortable' => $sortable,
        ])->with($this->formsData());
    }

    public function trash(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id',$id)->firstOrFail();

        $user->restore();

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::onlyTrashed()->where('id',$id)->firstOrFail();

        $user->forceDelete();

        return redirect()->route('users.trashed');
    }
    protected function formsData ()
    {

    }
}
