<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminInquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(15);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function markRead(Inquiry $inquiry)
    {
        $inquiry->update(['status' => 'read']);
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry marked as read.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }

    /**
     * Export all inquiries to CSV format.
     */
    public function export()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=inquiries_" . date('Ymd_His') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();

        $callback = function() use ($inquiries) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Country Code', 'Service Type', 'Message', 'Status', 'Date Submitted']);

            foreach ($inquiries as $inquiry) {
                fputcsv($file, [
                    $inquiry->id,
                    $inquiry->name,
                    $inquiry->email,
                    $inquiry->phone,
                    $inquiry->country_code,
                    $inquiry->service,
                    $inquiry->message,
                    $inquiry->status,
                    $inquiry->created_at ? $inquiry->created_at->format('Y-m-d H:i:s') : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
