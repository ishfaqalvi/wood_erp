<?php


use App\Models\Setting;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function uploadFile($file, $path, $width, $height)
{
    $extension = $file->getClientOriginalExtension();
    $name = uniqid().".".$extension;
 
    $folder = 'images/'.$path;
    $finalPath = $folder.'/'.$name;
    $file->move($folder, $name);
    dd(public_path($finalPath));
    Image::load(public_path($finalPath))->fit(Manipulations::FIT_CROP, $width, $height)->save();
    return $finalPath;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function settings($key)
{
    return Setting::get($key);
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function getAmount($item , $qty, $rate)
{
    $result = ($item->length /1000) * ($item->width/1000) * ($item->thikness/1000);
    return $result * 35.3147 * $qty * $rate;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function getMeasurement($item , $qty)
{
    $result = ($item->length /1000) * ($item->width/1000) * ($item->thikness/1000);
    return $result * 35.3147 * $qty * 12;
}

/**
 * Get the last balance of customer.
 *
 * @return \Illuminate\Http\Response
 */
function getCustomerLastBalance($customer)
{
    $curentRecord = $customer->details()->orderBy('id','DESC')->first();
    if ($curentRecord) {
        $lastBalnce = $customer->details()->where('id','!=',$curentRecord->id)->orderBy('id','DESC')->first();    
    }
    return $lastBalnce ? $lastBalnce->balance : 0;
}