<?php

namespace App\Http\Controllers\Admin;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $model = ContactUs::findOrFail($id);
        $model->fill(['is_read' => 1])->save();
        return view('admin.contacts.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'min:5|max:100',
            'email' => 'email|min:5|max:100',
            'subject' => '|min:5|max:100',
            'message' => 'min:5',
            'type' => 'integer',
        ];

        $this->validate($request, $rules);

        $records = ContactUs::findOrFail($id);
        $records->update($request->all());
        return redirect(route('contact.index'))->withFlashMessage('تم التعديل بنجاح');
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = ContactUs::findOrFail($id);
        $record->delete();
        flash()->success('تم حذف الرساله بنجاح');
        return redirect(route('contact.index'));
    }

    public function anyData()
    {
        $contacts = ContactUs::all();
        return DataTables::of($contacts)
            ->editColumn('name', function ($model) {
                return \Html::link(url(route('contact.edit', $model->id)), $model->name);
            })
            ->editColumn('type', function ($model) {
                return ' <span class="badge badge-warning"> ' . contactType()[$model->type] . ' </span> ';
            })
            ->editColumn('is_read', function ($model) {
                return $model->is_read == 0 ? ' <span class="badge badge-info">' . 'رساله جديده' . '</span> ' : ' <span class="badge badge-warning"> ' . 'رساله قديمه' . ' </span> ';
            })
            ->editColumn('control', function ($model) {
                $all = '<a href="' . url(route('contact.edit', $model->id)) . '" class="btn btn-info btn-circle"><i class="fa fa-edit xs"></i></a> ';

                $all .= '<a href="adminpanel/contact/' . $model->id . '/delete" class="btn btn-danger btn-circle"><i class="fa fa-trash xs"></i></a> ';
                return $all;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
