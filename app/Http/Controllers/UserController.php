<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info(Auth::user()->fullname . " Sedang Mengakses data kasir");
        if (request()->ajax()) {
            $Data = User::select('users.*', 'roles.name')
                        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                        ->where('name', '=', 'Cashier')->get();
            
            return DataTables::of($Data)->addIndexColumn()
                                        ->addColumn('action', function($item) {
                                            return '
                                                <div class="d-flex">
                                                    <a href="' . route('user.edit', $item->id) . '" class="ml-2 btn btn-warning shadow-none">
                                                        <span class="fas fa-edit"></span>
                                                    </a>
                                                    <form class="inline-block" action="' . route('user.destroy', $item->id) . '" method="POST">
                                                        <button class="ml-2 btn btn-danger shadow-none">
                                                            <span class="fas fa-trash"></span>
                                                        </button>
                                                        ' . method_field('delete') . csrf_field() . '
                                                    </form>
                                                </div>
                                            ';
                                        })->rawColumns(['action'])->make();
        }

        return view('master.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $Request)
    {
        try {
            $CashierRole = User::create([
                'fullname' => $Request->fullname,
                'email' => $Request->email,
                'password' => Hash::make($Request->password),
            ]);

            $CashierRole->assignRole('Cashier');

            Alert::success('Congrats', 'You\'ve Successfully Registered');
            return redirect()->route("user.index");
        } catch (QueryException $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route("user.index");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $User = User::where('id', $id)->get();

        return view('master.user.index', compact('User'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $Data = User::where('id', $id);

            $Data->update([
                'fullname' => $Request->fullname,
                'email' => $Request->email,
                'password' => Hash::make($Request->password),
            ]);

            Alert::success('Congrats', 'You\'ve Successfully Registered');
            return redirect()->route('user.index');
        } catch (QueryException $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        Alert::success('Congrats', 'You\'ve Successfully Deleted');
        return redirect()->route("user.index");
    }
}
