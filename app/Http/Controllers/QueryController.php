<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class QueryController extends Controller
{
    //
     ///wallet page retailers
     public function anyQuery(Request $request){
        return view('queries.query');
    }


    public function addQuery(Request $request)
    {
        $request->validate([
            'query' => 'required',

        ]);
        $query = Query::create([
            'user_id' =>auth()->user()->id,
            'query' => $request->input('query'),
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Query added successfully',
        ]);
    }

    public function getAddedqueries()
{
    $deposits = Query::select(['id', 'query', 'admin_response', 'status', 'created_at'])
    ->where('user_id', auth()->user()->id)
    ->get()
    ->map(function ($query) {
        // Format the created_at field to Asia/Kolkata timezone
        $query->created_at = Carbon::parse($query->created_at)
            ->timezone('Asia/Kolkata')
            ->format('Y-m-d '); // Desired format
        return $query;
    });

return DataTables::of($deposits)->make(true);
}

// Admin controller methods
public function AllQueriesView()
{
    return view('Admin.query.index');
}

public function AllQueriesRequest()
{
    $deposits = Query::with('user:id,first_name,last_name,username')
        ->select(['queries.id', 'queries.query', 'queries.admin_response', 'queries.status', 'queries.user_id']);

    return DataTables::of($deposits)
        ->addColumn('user_name', function ($deposit) {
            return $deposit->user->full_name ?? 'N/A'; // Access the full_name accessor
        })
        ->addColumn('username', function ($deposit) {
            return $deposit->user->username ?? 'N/A'; // Directly access username
        })
        ->make(true);
}

public function updateAdminResponse(Request $request)
{
    $request->validate([
        'query_id' => 'required|exists:queries,id',
        'admin_response' => 'required|string',
    ]);

    $query = Query::find($request->query_id);
    $query->admin_response = $request->admin_response;
    $query->status = 'Responded';  
    $query->save();

    return response()->json([
        'success' => true,
        'message' => 'Admin response updated successfully.'
    ]);
}



}
