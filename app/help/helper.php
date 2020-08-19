<?php

use App\Aqar;
use App\SiteSettings;


function aqar_type()
{
    $array = [
        'شقه',
        'فيلا',
        'شاليه'
    ];
    return $array;
}

function aqar_rent()
{
    $array = [
        'تمليك',
        'ايجار'
    ];
    return $array;
}

function aqar_status()
{
    $array = [
        'غير مفعل',
        'مفعل'
    ];
    return $array;
}

function roomNumber()
{
    $array = [];
    for ($i = 2; $i <= 40; $i++)
    {
        $array[$i] = $i;
    }
    return $array;
}

function searchName ()
{
    return [
      'bu_price' => 'سعر العقار',
        'bu_place'=> 'منطقة العقار',
        'rooms'=> 'عدد الغرف',
        'bu_type'=> 'نوع العقار',
        'bu_rent'=> 'نوع العمليه',
        'bu_square' => 'المساحه',
        'bu_price_from' => 'السعر من',
        'bu_price_to' => 'السعر الي',
    ];
}

function contactType()
{
    return [
        '1' => 'اعجاب',
        '2' => 'مشكله',
        '3' => 'اقتراح',
        '4' => 'استفسار',
    ];
}

function unReadMessage()
{
    return \App\ContactUs::where('is_read', 0)->get();
}

function countUnreadMessages()
{
    return \App\ContactUs::where('is_read', 0)->count();
}

function setActive($array, $class="active")
{
    if (!empty($array))
    {
        $segment = [];
        foreach ($array as $key => $url)
        {
            if (Request::segment($key+1) == $url)
            {
                $segment[] = $url;
            }
        }
        if (count($segment) == count(Request::segments()))
        {
            if (isset($segment[0])) {
                return $class;
            }

        }
    }
}

function aqarForUser($id, $status)
{
    return Aqar::where('bu_status', $status)->where('user_id', $id)->count();
}

function countWaitingAqars()
{
    return Aqar::where('bu_status', 0);
}

function countEnabledAqars()
{
    return Aqar::where('bu_status', 1);

}

function aqarPlace ()
{
    return  [
        '0' => 'الدقهليه',
        '1' => 'الغربيه',
        '2' => 'القاهره',
        '3' => 'الجيزه',
        '4' => 'البحيره',
        '5' => 'المنوفيه',
        '6' => 'الشرقيه',
        '7' => 'جنوب سيناء',
        '8' => 'شمال سيناء',
        '9' => 'القليوبيه',
        '10' => 'بورسعيد',
        '11' => 'الاسماعيليه',
        '12' => 'مرسي مطروح',
        '13' => 'شرم الشيخ',
        '14' => 'السويس',
        '15' => 'السادس من اكتوبر',
    ];
}


