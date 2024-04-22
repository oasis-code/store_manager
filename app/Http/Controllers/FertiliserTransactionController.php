<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Vehicle;
use App\Models\Fertiliser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FertiliserTransaction;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Auth;

class FertiliserTransactionController extends Controller
{
    //fertiliserin
    public function index_fertiliser_in()
    {
        $transactions = FertiliserTransaction::where('type', 'In')->orderBy('created_at', 'desc')->paginate(25);
        $user = Auth::user();
        return view('fertilisers.transactions.index-in', compact('transactions', 'user'));
    }


    public function report_fertiliser_in(Request $request)
    {
        $fertilisers = Fertiliser::all();
        $user = Auth::user();

        $query = FertiliserTransaction::query();

        

        if ($request->filled('fertiliser_id')) {
            $query->where('fertiliser_id', $request->input('fertiliser_id'));
        }


        if ($request->filled('from_date')) {
            $query->where('date', '>=', $request->input('from_date'));
        }

        if ($request->filled('to_date')) {
            $query->where('date', '<=', $request->input('to_date'));
        }

        $transactions = $query->where('type', 'In')
            ->where('is_reversed', false)
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('fertilisers.transactions.report-in', compact('transactions', 'user', 'fertilisers'));
    }

    public function create_fertiliser_in()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        $vehicles = Vehicle::all();
        $fertilisers = Fertiliser::all();
        return view('fertilisers.transactions.create-in', compact('user', 'vehicles', 'fertilisers'));
    }


    public function store_fertiliser_in(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([

            'type' => 'required|max:255',
            'date' => 'required|date',
            'no_of_packs' => 'required|numeric|min:0',
            'delivery_note_no' => 'required|max:255',
            'internal_delivery_no' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'fertiliser_id' => 'required|exists:fertilisers,id',
        ]);



        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create a new transaction
            $transaction = new FertiliserTransaction();
            $transaction->fill($validatedData);
            $transaction->save();


            $fertiliser = Fertiliser::find($request->fertiliser_id);
            $fertiliser->balance += $request->no_of_packs;
            $fertiliser->save();



            // Commit the database transaction
            DB::commit();

            return redirect()->route('fertiliser-in.index')->with('success', 'Transaction Added successfully.');
        } catch (\Exception $e) {
            // If an exception occurs, rollback the database transaction
            DB::rollback();

            return back()->withInput()->with('error', 'Failed to register the transaction. Please try again.');
        }
    }

    //reverse fertiliserin
    public function reverse_fertiliser_in(Request $request)
    {

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Find the transaction to reverse
            $transaction = FertiliserTransaction::findOrFail($request->transaction_id);

            // Ensure the transaction is not already reversed
            if ($transaction->is_reversed) {
                return back()->with('error', 'Transaction is already reversed.');
            }

            // Check if there is enough fertiliser in store
            $fertiliser = Fertiliser::find($request->fertiliser_id);
            if ($fertiliser->balance < $transaction->no_of_packs) {
                DB::rollback();
                return back()->withInput()->with('error', 'Insufficient fertiliser in the store to cover this transaction!.');
            }

            // Create a new reverse transaction
            $reverseTransaction = new FertiliserTransaction();
            $reverseTransaction->fill([
                'type' => $transaction->type,
                'date' => $transaction->date,
                'delivery_note_no' => $transaction->delivery_note_no,
                'internal_delivery_no' => $transaction->internal_delivery_no,
                'fertiliser_id' => $transaction->fertiliser_id,
                'no_of_packs' => $transaction->no_of_packs,
                'user_id' => $transaction->user_id,
                'vehicle_id' => $transaction->vehicle_id,
                'reverses' => $transaction->id,
                'is_reversed' => true,
            ]);
            // dd($reverseTransaction);
            $reverseTransaction->save();

            // Reverse the transaction and mark it as reversed
            $transaction->reversed_by = $reverseTransaction->id;
            $transaction->is_reversed = true;
            $transaction->reversal_reason = $request->reversal_reason;
            $transaction->save();


            $fertiliser = Fertiliser::find($transaction->fertiliser_id);
            $fertiliser->balance -= $transaction->no_of_packs;
            $fertiliser->save();

            // Commit the database transaction
            DB::commit();

            return redirect()->route('fertiliser-in.index')->with('success', 'Transaction Reversed successfully.');
        } catch (\Exception $e) {
            // If an exception occurs, rollback the database transaction
            DB::rollback();

            return back()->withInput()->with('error', 'Failed to register the transaction. Please try again.');
        }
    }


    //fertiliserOUT
    public function index_fertiliser_out()
    {
        $transactions = FertiliserTransaction::where('type', 'Out')->orderBy('created_at', 'desc')->paginate(25);
        $user = Auth::user();
        return view('Fertilisers.transactions.index-out', compact('transactions', 'user'));
    }


    public function report_fertiliser_out(Request $request)
    {
        $categories = VehicleCategory::all();
        $vehicles = Vehicle::all();
        $user = Auth::user();

        $query = FertiliserTransaction::query();

        // Apply filters
        if ($request->filled('category_id')) {
            $query->whereHas('vehicle.category', function ($query) use ($request) {
                $query->where('id', $request->input('category_id'));
            });
        }

        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', $request->input('vehicle_id'));
        }

        if ($request->filled('from_date')) {
            $query->where('date', '>=', $request->input('from_date'));
        }

        if ($request->filled('to_date')) {
            $query->where('date', '<=', $request->input('to_date'));
        }

        $transactions = $query->where('type', 'Out')
            ->where('is_reversed', false)
            ->orderBy('created_at', 'asc')
            ->paginate(50);

            $fertiliser = Fertiliser::all();
        $balance = $fertiliser->balance;
        return view('fertiliser.transactions.report-out', compact('transactions', 'user', 'balance', 'categories', 'vehicles'));
    }

    public function report_fertiliser_out_sum(Request $request)
    {

        $user = Auth::user();

        if ($request->filled('year')) {
            $year = $request->input('year', date('Y'));
        } else {
            $year = date('Y');
        }

        // Fetch fertiliser transactions with related vehicle and category
        $FertiliserTransactions = FertiliserTransaction::with('vehicle.category')
            ->where('type', 'Out')
            ->where('is_reversed', false)
            ->whereYear('date', $year)
            ->get();

        // Initialize an array to store the summary data
        $summaryData = [];
        //array to store years
        $yearsArray = array();
        // Loop through years from 2020 to 2030 and add them to the array
        for ($y = 2020; $y <= 2030; $y++) {
            $yearsArray[] = $y;
        }

        // Iterate over fertiliser transactions to calculate totals per category and vehicle
        foreach ($fertiliserTransactions as $transaction) {
            $categoryName = $transaction->vehicle->category->name;
            $vehicleName = strtoupper(substr($transaction->vehicle->category->name, 0, 1)) . '/' . $transaction->vehicle->model . '/' . $transaction->vehicle->number_plate;
            $month = date('M', strtotime($transaction->date));
            $quantity = $transaction->quantity;

            // Add quantity to the corresponding category subtotal
            $summaryData[$categoryName]['total'] = isset($summaryData[$categoryName]['total']) ? $summaryData[$categoryName]['total'] + $quantity : $quantity;
            // Add quantity to the corresponding vehicle subtotal
            $summaryData[$categoryName]['vehicles'][$vehicleName][$month] = isset($summaryData[$categoryName]['vehicles'][$vehicleName][$month]) ? $summaryData[$categoryName]['vehicles'][$vehicleName][$month] + $quantity : $quantity;
        }



        return view('fertilisers.transactions.report-out-sum', compact('summaryData', 'user', 'year', 'yearsArray'));
    }



    public function create_fertiliser_out()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        $operators = People::where('role', 'Operator')->get();
        $fertilisers = Fertiliser::all();
        return view('fertilisers.transactions.create-out', compact('user', 'fertilisers', 'operators'));
    }

    public function store_fertiliser_out(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([

            'type' => 'required|max:255',
            'date' => 'required|date',
            'no_of_packs' => 'required|numeric|min:0',
            'receipt_no' => 'required|max:255',
            'destination' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'person_id' => 'required|exists:people,id',
            'fertiliser_id' => 'required|exists:fertilisers,id',
        ]);


        try {
            // Start a database transaction
            DB::beginTransaction();

             // Check if there is enough fertiliser in store
             $fertiliser = Fertiliser::find($request->fertiliser_id);
             if ($fertiliser->balance < $request->no_of_packs) {
                 DB::rollback();
                 return back()->withInput()->with('error', 'Insufficient fertiliser in the store to cover this transaction!.');
             }

            // Create a new transaction
            $transaction = new FertiliserTransaction();
            $transaction->fill($validatedData);
            $transaction->save();

            $fertiliser = Fertiliser::find($request->fertiliser_id);
            $fertiliser->balance -= $request->no_of_packs;
            $fertiliser->save();

            // Commit the database transaction
            DB::commit();

            return redirect()->route('fertiliser-out.index')->with('success', 'Transaction Added successfully.');
        } catch (\Exception $e) {
            // If an exception occurs, rollback the database transaction
            DB::rollback();

            return back()->withInput()->with('error', 'Failed to register the transaction. Please try again.');
        }
    }

    //reverse fertiliserout
    public function reverse_fertiliser_out(Request $request)
    {

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Find the transaction to reverse
            $transaction = FertiliserTransaction::findOrFail($request->transaction_id);

            // Ensure the transaction is not already reversed
            if ($transaction->is_reversed) {
                return back()->with('error', 'Transaction is already reversed.');
            }

            // Create a new reverse transaction
            $reverseTransaction = new FertiliserTransaction();
            $reverseTransaction->fill([
                'type' => $transaction->type,
                'date' => $transaction->date,
                'receipt_no' => $transaction->receipt_no,
                'destination' => $transaction->destination,
                'fertiliser_id' => $transaction->fertiliser_id,
                'no_of_packs' => $transaction->no_of_packs,
                'user_id' => $transaction->user_id,
                'person_id' => $transaction->person_id,
                'reverses' => $transaction->id,
                'is_reversed' => true,
            ]);
            // dd($reverseTransaction);
            $reverseTransaction->save();

            // Reverse the transaction and mark it as reversed
            $transaction->reversed_by = $reverseTransaction->id;
            $transaction->is_reversed = true;
            $transaction->reversal_reason = $request->reversal_reason;
            $transaction->save();


            $fertiliser = Fertiliser::find($transaction->fertiliser_id);
            $fertiliser->balance += $transaction->no_of_packs;
            $fertiliser->save();

            // Commit the database transaction
            DB::commit();

            return redirect()->route('fertiliser-out.index')->with('success', 'Transaction Reversed successfully.');
        } catch (\Exception $e) {
            // If an exception occurs, rollback the database transaction
            DB::rollback();

            return back()->withInput()->with('error', 'Failed to register the transaction. Please try again.');
        }
    }
    
}
