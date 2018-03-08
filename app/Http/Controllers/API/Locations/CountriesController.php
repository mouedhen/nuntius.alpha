<?php

namespace App\Http\Controllers\API\Locations;

use App\Traits\API\Helpers\RestTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\Resource;
use PragmaRX\Countries\Package\Countries;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CountriesController extends Controller
{
    use RestTrait;

    public function index()
    {
        return Resource::collection(Countries::all());
    }

    public function show($CCA2)
    {
        $id = strtoupper($CCA2);
        $country = Countries::where('cca2', $id);
        if ($country->isEmpty()) throw new NotFoundHttpException('404 NOT FOUND');
        return new Resource($country);
    }
}
