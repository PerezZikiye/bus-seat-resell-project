<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingAdminController extends Controller
{
    // Admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Display all bookings
    public function index()
    {
        $bookings = Booking::with('user')->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // Export bookings to CSV
    public function exportCsv()
    {
        $bookings = Booking::with('user')->get();
        $filename = 'bookings.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function () use ($bookings) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['User', 'From', 'To', 'Date', 'Time', 'Seats', 'Amount', 'Status']);

            foreach ($bookings as $booking) {
                fputcsv($handle, [
                    $booking->user->name ?? 'N/A',
                    $booking->from,
                    $booking->to,
                    $booking->travel_date,
                    $booking->travel_time,
                    $booking->seats,
                    $booking->amount,
                    ucfirst($booking->status),
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    // Export bookings to PDF
    public function exportPdf()
    {
        $bookings = Booking::with('user')->get();
        $pdf = Pdf::loadView('admin.bookings.pdf', compact('bookings'));

        return $pdf->download('bookings.pdf');
    }
}
