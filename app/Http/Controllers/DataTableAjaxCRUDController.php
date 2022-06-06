<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;


class DataTableAjaxCRUDController extends Controller
{
    public function index()
    {

        $countries = DB::table("country")->select("id", "sortname", "country_name")->get();
        // return view('companies',compact('countries'));

        if (request()->ajax()) {
            return datatables()->of(Company::select('*'))
                ->addColumn('action', 'company-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('companies', compact(['countries']));
    }



    public function getStateList(Request $request)
    {
        $state = DB::table("state")->select("id", "state_name")
            ->where("country_id", $request->country_id)->get();
        return response()->json($state);
    }

    public function getCityList(Request $request)
    {
        $city = DB::table("city")->select("id", "city_name")
            ->where("state_id", $request->state_id)->get();

        return response()->json($city);
    }


    public function store(Request $request)
    {

        $name = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image'), $name);
        $request->image = $name;

        $companyId = $request->id;

        $company = Company::updateOrCreate(
        [
            'id' => $companyId
        ],
        [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'image' => $name,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'hobbies' => implode(',', $request->hobbies)
        ]);

        return Response()->json($company);

    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $company = Company::where($where)->first();

        return Response()->json($company);
    }

    public function destroy(Request $request)
    {
        $company = Company::where('id', $request->id)->delete();

        return Response()->json($company);
    }




}