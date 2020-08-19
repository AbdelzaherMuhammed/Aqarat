<?php

namespace App\Http\Controllers\Admin;

use App\Aqar;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class AqarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id !== null ? '?user_id='.$request->id : null;
        return view('admin.aqars.index',compact('id'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aqars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'bu_name' => 'required|min:5|max:100',
            'bu_price' => 'required|numeric',
            'bu_rent' => 'required|integer',
            'bu_square' => 'required|min:2|max:100',
            'bu_type' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bu_small_disc' => 'required|min:5|max:160',
            'bu_meta' => 'required|min:5|max:200',
//            regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/
            'bu_longitude' => 'required',
//            regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/
            'bu_latitude' => 'required',
            'bu_large_disc' => 'required|min:5',
            'bu_status' => 'required|integer',
            'rooms' => 'required|integer',
            'month' => date('m'),
            'year' => date('Y'),
        ];

        $this->validate($request, $rules);

        $user = auth()->user();

        $records = $user->aqars()->create($request->all());

        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/images/'; // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given path
            $records->image = $name;
            $records->save();
        }

        flash()->success('تم اضافة العقار بنجاح');

        return redirect(url('adminpanel/aqar'));

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aqar $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Aqar::findOrFail($id);

        if ($model->user_id == 0)
        {
            $user = '';
        } else {
            $user = User::where('id', $model->user_id)->get()[0];
        }



        return view('admin.aqars.edit', compact('model', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'bu_name' => 'min:5|max:100',
            'bu_price' => 'numeric',
            'bu_rent' => 'integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'bu_square' => 'min:2|max:100',
            'bu_type' => 'integer',
            'bu_small_disc' => 'max:160',
            'bu_meta' => 'min:5|max:200',
            'bu_large_disc' => 'min:5',
            'bu_status' => 'integer',
            'rooms' => 'integer',
        ];

        $this->validate($request, $rules);


        $records = Aqar::findOrFail($id);
        $records->update($request->all());

        if ($request->hasFile('image')) {

             $dim = getimagesize($request->file('image'));
             $width = $dim[0];
             $height = $dim[1];

            $path = public_path();
            $destinationPath = $path . '/images/';
            if (file_exists($destinationPath . $records->image)) {
                 unlink($destinationPath . $records->image);
            }
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $image->move($destinationPath, $name); // uploading file to given path
                $records->image = $name;
                $records->save();
                if($width != 400 && $height != 400)
                {
                    $imagePath = $destinationPath. $name;
                    Image::make($destinationPath. $name)->resize(400, 400)->save($imagePath, 100);
                }
            }
        flash()->success('تم التعديل بنجاح');
        return redirect(url('adminpanel/aqar'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $records = Aqar::findOrFail($id);

        $records->delete();

        flash()->success('تم الحذف بنجاح');
        return redirect(url('adminpanel/aqar'));
    }

    public function anyData(Request $request )
    {
        if ($request->user_id)
        {
            $aqars = Aqar::where('user_id', $request->user_id)->get();
        } else {
            $aqars = Aqar::all();
        }
        return DataTables::of($aqars)
            ->editColumn('bu_name', function ($model) {
                return \Html::link(url(route('aqar.edit', $model->id)), $model->bu_name);
            })
            ->editColumn('bu_type', function ($model) {
                $type = aqar_type();
                return ' <span class="badge badge-info">' . $type[$model->bu_type] . '</span> ';
            })
            ->editColumn('bu_status', function ($model) {
                return $model->bu_status == 0 ? ' <span class="badge badge-info">' . 'غير مفعل' . '</span> ' : ' <span class="badge badge-warning"> ' . 'مفعل' . ' </span> ';
            })
            ->editColumn('control', function ($model) {
                $all = '<a href="' . url(route('aqar.edit', $model->id)) . '" class="btn btn-info btn-circle"><i class="fa fa-edit xs"></i></a> ';

                $all .= '<a href="adminpanel/aqar/' . $model->id . '/delete" class="btn btn-danger btn-circle"><i class="fa fa-trash xs"></i></a> ';

                return $all;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function changeAqarStatus($id)
    {
        $record = Aqar::findOrFail($id);

        $record->bu_status =! $record->bu_status;
        $record->save();

        return back()->withFlashMessage('تم تغيير حالة العقار بنجاح');



    }

}



