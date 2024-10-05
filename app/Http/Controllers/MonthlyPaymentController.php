<?php

namespace App\Http\Controllers;

use App\Models\MonthlyPayment;
use App\Models\Moon;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonthlyPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Pembayaran";
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $month = $request->input('month');
        $year = $request->input('year');
        $search = $request->input("search");

        $moons = Moon::all();
        $years = range(2023, 2033);

        if ($month && $year) {
            if ($search) {
                $payments = MonthlyPayment::with("student", "moon")
                    ->whereHas('student', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->where('moon_id', $month)
                    ->where('year', $year)
                    ->paginate(15);
            } else {
                $payments = MonthlyPayment::with("student", "moon")
                    ->where('moon_id', $month)
                    ->where('year', $year)
                    ->paginate(25);
            }
        } else {
            if ($search) {
                $payments = MonthlyPayment::with("student", "moon")
                    ->whereHas('student', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->where('moon_id', $currentMonth)
                    ->where('year', $currentYear)
                    ->paginate(15);
            } else {
                $payments = MonthlyPayment::with("student", "moon")
                    ->where('moon_id', $currentMonth)
                    ->where('year', $currentYear)
                    ->paginate(25);
            }
        }

        return view("pages.monthly-payment.index", compact(
            "title",
            "moons",
            "years",
            "payments",
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Pembayaran";
        $moons = Moon::all();
        $month = Carbon::now()->month;
        $years = range(2023, 2033);
        $year = Carbon::now()->year;
        $students = Student::orderBy("name", "ASC")->get();
        $status = ["Cicil", "Lunas"];
        return view("pages.monthly-payment.create", compact(
            "title",
            "moons",
            "month",
            "years",
            "year",
            "students",
            "status",
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'moon_id' => 'required',
            'year' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:Cicil,Lunas',
        ]);

        $monthlyPayment = MonthlyPayment::create($request->all());

        return redirect()->route('admin.monthly-payment.index')
            ->with('success', 'Pembayaran bulan ' . $monthlyPayment->moon->name . ' atas nama ' . $monthlyPayment->student->name . ' berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = MonthlyPayment::findOrFail($id);
        $title = "Pembayaran";
        $moons = Moon::all();
        $month = Carbon::now()->month;
        $years = range(2023, 2033);
        $year = Carbon::now()->year;
        $students = Student::orderBy("name", "ASC")->get();
        $status = ["Cicil", "Lunas"];
        return view("pages.monthly-payment.edit", compact(
            "payment",
            "title",
            "moons",
            "month",
            "years",
            "year",
            "students",
            "status",
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'student_id' => 'required',
            'moon_id' => 'required',
            'year' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:Cicil,Lunas',
        ]);

        $payment = MonthlyPayment::findOrFail($id);
        $payment->update($request->all());

        return redirect()->route('admin.monthly-payment.index')
            ->with('success', 'Pembayaran atas nama ' . $payment->student->name . ' pada bulan ' . $payment->moon->name . ' telah diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = MonthlyPayment::with('student', 'moon')->findOrFail($id);
        $payment->delete();

        return redirect()->back()->with('success', 'Pembayaran atas nama ' . $payment->student->name . ' telah dihapus.');
    }

    public function export(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $month = $request->input('month');
        $year = $request->input('year');

        $moons = Moon::all();
        $years = range(2023, 2033);

        if ($month && $year) {
            $monthlyPayments = MonthlyPayment::with("student", "moon")
                ->where('moon_id', $month)
                ->where('year', $year)
                ->orderBy('updated_at', 'asc')
                ->get();

            $pdf = Pdf::loadView('pages.pdf.monthly-payment', compact('monthlyPayments', 'month', 'year'))
                ->setPaper('A4', 'landscape');

            return $pdf->stream('laporan-pembayaran-bulan-' . $month . '-tahun-' . $year . '.pdf');
        } elseif ($year) {
            $monthlyPayments = MonthlyPayment::with("student", "moon")
                ->where('year', $year)
                ->orderBy('moon_id', 'asc')
                ->get();

            $pdf = Pdf::loadView('pages.pdf.monthly-payment', compact('monthlyPayments', 'month', 'year'))
                ->setPaper('A4', 'landscape');

            return $pdf->stream('laporan-pembayaran-bulanan-tahun-' . $currentYear . '.pdf');
        } else {
            $monthlyPayments = MonthlyPayment::with("student", "moon")
                ->where('year', $currentYear)
                ->orderBy('moon_id', 'asc')
                ->get();

            $pdf = Pdf::loadView('pages.pdf.monthly-payment', compact('monthlyPayments', 'month', 'year'))
                ->setPaper('A4', 'landscape');

            return $pdf->stream('laporan-pembayaran-bulanan-tahun-' . $currentYear . '.pdf');
        }
    }
}
