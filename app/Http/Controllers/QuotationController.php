<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Quotation;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::latest()->get();
        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        $categories = MenuCategory::with('activeMenuItems')->active()->get();
        return view('quotations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_place' => 'required|string|max:255',
            'client_contact' => 'required|string|max:20',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|string|max:255',
            'event_time' => 'required|string|max:255',
            'number_of_people' => 'required|integer|min:1',
            'per_plate_price' => 'required|numeric|min:0',
            'menu_items' => 'required|array|min:1'
        ]);

        $totalAmount = $request->number_of_people * $request->per_plate_price;

        $quotation = Quotation::create([
            'client_name' => $request->client_name,
            'client_place' => $request->client_place,
            'client_contact' => $request->client_contact,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'number_of_people' => $request->number_of_people,
            'per_plate_price' => $request->per_plate_price,
            'total_amount' => $totalAmount
        ]);

        foreach ($request->menu_items as $menuItemId) {
            $quotation->quotationItems()->create(['menu_item_id' => $menuItemId]);
        }

        return redirect()->route('quotations.show', $quotation)->with('success', 'Quotation created successfully.');
    }

    public function show(Quotation $quotation)
    {
        $quotation->load('quotationItems.menuItem.category');
        return view('quotations.show', compact('quotation'));
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();
        return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully.');
    }

    public function downloadPdf(Quotation $quotation)
    {
        $quotation->load('quotationItems.menuItem.category');
        $pdf = PDF::loadView('quotations.pdf', compact('quotation'));
        $fileName = $quotation->client_name . '-quotation-' . $quotation->quotation_number . '.pdf';

        return $pdf->download($fileName);
    }

    public function viewPdf(Quotation $quotation)
    {
        $quotation->load('quotationItems.menuItem.category');
        $pdf = PDF::loadView('quotations.pdf', compact('quotation'));

        return $pdf->stream('quotation-' . $quotation->quotation_number . '.pdf');
    }

    public function shareViaWhatsApp(Quotation $quotation)
    {
        $quotation->load('quotationItems.menuItem.category');

        // Generate PDF
        $pdf = PDF::loadView('quotations.pdf', compact('quotation'));
        $fileName = $quotation->client_name . '-quotation-' . $quotation->quotation_number . '.pdf';

        // Save to storage
        Storage::disk('public')->put('quotations/' . $fileName, $pdf->output());

        // Generate public URL
        $pdfUrl = asset('storage/quotations/' . $fileName);


        $phone = $quotation->client_contact;



        $eventDate = Carbon::parse($quotation->event_date)->format('d M Y');

        // Create WhatsApp message
        $message = "Hello {$quotation->client_name}, here is your quotation from Adens Events:\n\n";
        $message .= "Event: {$quotation->event_name}\n";
        $message .= "Date & Time: {$eventDate},{$quotation->event_time} \n";
        $message .= "Total Amount: ₹" . number_format($quotation->total_amount, 2) . "\n\n";
        $message .= "Download your quotation: {$pdfUrl}";

        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        return redirect()->away($whatsappUrl);
    }
}
