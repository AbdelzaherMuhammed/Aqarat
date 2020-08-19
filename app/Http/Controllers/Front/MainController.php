<?php

namespace App\Http\Controllers\Front;

use App\Aqar;
use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MainController extends Controller
{
    public function showAllEnabled()
    {
        $records = Aqar::where('bu_status', 1)->orderBy('id', 'desc')->paginate(15);

        return view('website.aqar.all_aqars', compact('records'));
    }

    public function forRent()
    {
        $records = Aqar::where('bu_status', 1)->where('bu_rent', 1)->orderBy('id', 'desc')->paginate(15);

        return view('website.aqar.all_aqars', compact('records'));
    }

    public function forBuy()
    {
        $records = Aqar::where('bu_status', 1)->where('bu_rent', 0)->orderBy('id', 'desc')->paginate(15);

        return view('website.aqar.all_aqars', compact('records'));
    }

    public function showByType(Request $request, $id)
    {
        if (in_array($id, ['0', '1', '2', '3'])) {
            $records = Aqar::where('bu_status', 1)->where('bu_type', $request->id)->orderBy('id', 'desc')->paginate(15);

            return view('website.aqar.all_aqars', compact('records'));
        } else {
            return back();
        }
    }

    public function search(Request $request)
    {

        $requestAll = Arr::except($request->toArray(), ['submit', '_token', 'page']);
        $query = DB::table('aqars')->select('*');
        $array = [];
        $count = count($requestAll);
        $i = 1;
        foreach ($requestAll as $key => $req) {
            $i++;
            if ($req != null) {
                if ($key == 'bu_price_from' && $request->bu_price_to == null) {
                    $query->where('bu_price', '>=', $req);
                } elseif ($key == 'bu_price_to' && $request->bu_price_from == null) {
                    $query->where('bu_price', '<=', $req);
                } else {
                    if ($key != 'bu_price_from' && $key != 'bu_price_to') {
                        $query->where($key, $req);
                    }
                }
                $array[$key] = $req;
            } elseif ($count == $i && $request->bu_price_from != null && $request->bu_price_to != null) {
                $query->whereBetween('bu_price', [$request->bu_price_from, $request->bu_price_to]);
            }
        }
        $records = $query->paginate(15);

        return view('website.aqar.all_aqars', compact('records', 'array'));
//        $requestAll = Arr::except($request->toArray(), ['submit', '_token']);
//
//        $out= null;
//        $i = 0;
//        foreach ($requestAll as $key =>$req)
//        {
//            if ($req != null)
//            {
//                $where = $i==0 ? "WHERE" : " AND";
//                $out .= $where . ' ' . $key . ' = ' . $req ;
//                $i=2;
//            }
//        }
//        $query = "SELECT * FROM aqars ".$out;
//
//        $records = DB::select($query);
//
//        $search = 'search';
//        $records = Aqar::where('bu_status', 1)
//            ->where('bu_type', $request->type)
//            ->where('rooms', $request->room_number)
//            ->where('bu_price', $request->price)
//            ->where('bu_square', $request->square)
//            ->where('bu_rent', $request->rent)
//            ->orderBy('id', 'desc')->paginate(6);

    }

    public function showDetails($id)
    {
        $record = Aqar::findOrFail($id);

        if ($record->bu_status == 0) {
            $messageTitle = "هذا العقار ينتظر موافقة الاداره";
            $messageBody = " العقار $record->bu_name  موجود لدينا ولكن في انتظار موافقة الاداره عليه
                        يتم نشر العقار في مده اقصاها 24 ساعه";
            return view('website.aqar.no-permission', compact('record', 'messageTitle', 'messageBody'));
        }

        $sameArarsRent = Aqar::where('bu_rent', $record->bu_rent)->orderBy(DB::raw('Rand()'))->take(3)->get();
        $sameArarsType = Aqar::where('bu_type', $record->bu_type)->orderBy(DB::raw('Rand()'))->take(3)->get();


        return view('website.aqar.aqar-details', compact('record', 'sameArarsRent', 'sameArarsType'));
    }

    public function getAjaxInfo(Request $request)
    {
        return Aqar::findOrFail($request->id)->toJson();
    }


    public function showContact()
    {
        return view('website.contact.contact-us');
    }


    public function contactCreate(Request $request)
    {
        $rules = [
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|min:5|max:100',
            'subject' => '|min:5|max:100',
            'message' => 'required|min:5',
            'type' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $contact = ContactUs::create($request->all());

        return back()->withFlashMessage('تم ارسال رسالتك بنجاح');
    }

    public function userAddAqar()
    {
        return view('website.user-aqar.user-add');
    }

    public function userCreateAqar(Request $request)
    {
        $rules = [
            'bu_name' => 'required|min:5|max:100',
            'bu_price' => 'required|numeric',
            'bu_rent' => 'required|integer',
            'bu_square' => 'required|min:2|max:100',
            'bu_type' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bu_small_disc' => strip_tags(Str::limit('min:5|max:160', 160)),
            'bu_meta' => 'required|min:5|max:200',
            'bu_longitude' => 'required',
            'bu_latitude' => 'required',
            'bu_large_disc' => 'required|min:5',
            'rooms' => 'required|integer',
            'month' => date('m'),
            'year' => date('Y'),
        ];

        $this->validate($request, $rules);

        if (auth()->user()) {
            $user = auth()->user();
            $records = $user->aqars()->create($request->all());
        } else {
            $records = Aqar::create($request->all());
        }
        if ($request->hasFile('image')) {

            $dim = getimagesize($request->file('image'));
            $width = $dim[0];
            $height = $dim[1];

            $path = public_path();
            $destinationPath = $path . '/images/'; // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given path
            $records->image = $name;
            $records->save();

            if ($width != 1600 && $height != 500) {
                $imagePath = $destinationPath . $name;
                Image::make($destinationPath . $name)->resize(400, 400)->save($imagePath, 100);
            }
        }

        flash()->success('تم اضافة العقار بنجاح');

        return view('website.user-aqar.done');
    }

    public function userBuildingShow()
    {
        $records = auth()->user()->aqars()->where('bu_status', 1)->paginate(10);

        return view('website.user-aqar.show-user-aqar', compact('records'));

    }

    public function userBuildingWaiting()
    {
        $records = auth()->user()->aqars()->where('bu_status', 0)->paginate(10);

        return view('website.user-aqar.show-user-aqar', compact('records'));

    }

    public function userEditAqar($id)
    {
        $user = auth()->user();

        $record = Aqar::findOrFail($id);

        if ($user->id != $record->user_id) {
            $messageTitle = "هذا العقار تمت اضافته من قبل عضو اخر";
            $messageBody = "هذا العقار
            $record->bu_name
            لم تقم باضافته ، تمت اضافته من خلال عضوية اخري
            ";
            return view('website.aqar.no-permission', compact('record', 'messageTitle', 'messageBody'));

        } elseif ($record->bu_status == 1) {
            $messageTitle = "هذا العقار تم تفعيله";
            $messageBody = " العقار
            $record->bu_name
            تم تفعيله ولا يمكن التعديل عليه حاليا ، في حال أردت التعديل عليه برجاء الذهاب الي اتصل بنا وارسال طلب تعديل
            ";
            return view('website.aqar.no-permission', compact('record', 'messageTitle', 'messageBody'));
        }

        $model = $record;
        return view('website.user-aqar.user-edit', compact('model'));
    }

    public function userUpdateAqar(Request $request)
    {
        $rules = [
            'bu_name' => 'min:5|max:100',
            'bu_price' => 'numeric',
            'bu_rent' => 'integer',
            'bu_square' => 'min:2|max:100',
            'bu_type' => 'integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'bu_small_disc' => strip_tags(Str::limit('min:5|max:160', 160)),
            'bu_meta' => 'min:5|max:200',
            'bu_longitude' => 'required',
            'bu_latitude' => 'required',
            'bu_large_disc' => 'min:5',
            'rooms' => 'integer',
        ];

        $this->validate($request, $rules);

        $records = Aqar::findOrFail($request->bu_id);

        $records->update($request->all());

        if ($request->hasFile('image')) {

            $dim = getimagesize($request->file('image'));
            $width = $dim[0];
            $height = $dim[1];

            $path = public_path();
            $destinationPath = $path . '/images/'; // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given path
            $records->image = $name;
            $records->save();

            if ($width != 1600 && $height != 500) {
                $imagePath = $destinationPath . $name;
                Image::make($destinationPath . $name)->resize(400, 400)->save($imagePath, 100);
            }
        }

        return back()->withFlashMessage('تم التعديل بنجاح');


    }
}
