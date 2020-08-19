<?php

namespace App\Http\Controllers\Admin;


use App\Aqar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.user.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User() ;
        $request->merge(['password' => bcrypt($request->password)]);
        $user->create($request->all());
        return redirect(route('user.index'))->withFlashMessage('تم اضافة العضو بنجاح');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $aqarWaiting = Aqar::where('user_id', $id)->where('bu_status', 0)->paginate(10);
        $aqarEnabled = Aqar::where('user_id', $id)->where('bu_status', 1)->paginate(10);
        return view('admin.user.edit' , compact('user', 'aqarWaiting', 'aqarEnabled'));
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
        $rules = [
            'name' => '|string|max:255',
            'email' =>  'string|email|max:255|unique:users,email,'.$id,
            'password' =>  'string', 'min:8', 'confirmed',
        ];
        $this->validate($request ,$rules);

        $user = User::findOrFail($id);
        $request->merge(['password' => bcrypt('password')]);
        $user->update($request->all());
        flash()->success('تم تعديل العضو بنجاح');
        return redirect(route('user.index'));

    }

    public function updatePassword(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $password = bcrypt($request->password);
        $user->fill(['password' => $password])->save();
        flash()->success('تم تعديل كلمة المرور بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != 1){
            $user = User::findOrFail($id);
            $user->delete();
            Aqar::where('user_id', $id)->delete();
            flash()->success('تم حذف العضو بنجاح');
            return redirect(route('user.index'));
        }else{
            flash()->error('لا يمكن حذف هذا العضو');
            return back();
        }


    }

    public function anyData()
    {
        $users = User::all();
        return DataTables::of($users)
            ->editColumn('name' , function ($model){
                return \Html::link(url(route('user.edit' , $model->id)) , $model->name);
            })
            ->editColumn('admin' , function ($model){
                return $model->admin == 0 ? ' <span class="badge badge-info">' . 'عضو' . '</span> ' : ' <span class="badge badge-warning"> ' . 'مدير الموقع' . ' </span> ';
            })
            ->editColumn('my_aqars' , function ($model){
                return '<a href="'.url('adminpanel/aqar' , $model->id).'"><span class="btn btn-info btn-circle"><i class="fa fa-link xs"></i></span></a> ';
            })
            ->editColumn('control' , function ($model){
                $all = '<a href="'.url(route('user.edit' , $model->id)).'" class="btn btn-info btn-circle"><i class="fa fa-edit xs"></i></a> ';

                if($model->id != 1){
                    $all .= '<a href="adminpanel/user/' . $model->id . '/delete" class="btn btn-danger btn-circle"><i class="fa fa-trash xs"></i></a> ';
                }

                return $all;
            })
            ->escapeColumns([])
            ->make(true);
    }
}

