<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\User;
use Helper;
use DataTables;
use  App\Http\Requests\Admin\User\StoreRequest;
use  App\Http\Requests\Admin\User\UpdateRequest;
use  App\Jobs\RegisterUserJob;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('actor', 2);
            return Datatables::of($users)
                ->addColumn('action', function ($row) {

                    $btn = '<a href=' . route("admin.user.edit", $row->id) . ' class="edit btn btn-primary btn-sm">Edit</a>';

                    $btn .= '<form  action=' . route("admin.user.destroy", $row->id) . ' method="post">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="submit" class="delete_record" value="Delete">
                            </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = new User();
        return view('admin.user.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $this->fillableFields($request);
        $user = new User();
        $user->fill($data);
        $user->save();


        dispatch(new RegisterUserJob($user));

        return redirect()->route('admin.user.index')->with('success', 'User save successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $this->fillableFields($request);
        $user->fill($data);
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User delete successfully');
    }

    private function fillableFields($request)
    {
        $data = $request->only('email', 'name');
        if ($request->has('password') && $request->get('password') != '') {
            $data['password'] = bcrypt($request->get('password'));
        }
        return $data;
    }
}
