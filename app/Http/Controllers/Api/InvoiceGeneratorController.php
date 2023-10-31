<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Http\Requests\StoreInvoicesRequest;
use App\Http\Requests\UpdateInvoicesRequest;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Log;

use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class InvoiceGeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userSettings = UserSettings::where('user_id', auth()->user()->id)->first();
        if ($userSettings) {
            return Response::json(['data' => $userSettings], 201);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoicesRequest  $request
     * @return \Illuminate\Http\Response
     */

    /*public function store(StoreInvoicesRequest $request)
    {
        $data = $request;
        $invoiceData = $request;

        // Handle image resizing
        // if ($invoiceData['image']) {
        //     // Decode the base64 image
            $imageData = base64_decode($invoiceData['image']);

        //     // Generate a unique filename
        //     $filename = uniqid() . '.png'; // You can choose a different extension based on the image type

        //     // Save the image to a directory (e.g., public_path('images'))
        //     file_put_contents(storage_path('images/' . $filename), $imageData);

        //     // Store the file path in the database
        //     $image = new Image([
        //         'path' => 'images/' . $filename,
        //         'description' => 'Image description',
        //     ]);

        //     $image->save();
        // }
        // return;
        $tempImagePath = tempnam(sys_get_temp_dir(), 'temp_image');
        file_put_contents($tempImagePath, $imageData);
        
        // Use Spatie Image to manipulate the image
        $image = Image::load($tempImagePath);
        
        // Perform manipulations (e.g., resize)
        $image->fit(Manipulations::FIT_CONTAIN, 100, 100);
        
        // Save the manipulated image to a different file if needed
        $manipulatedImagePath = 'path_to_save_manipulated_image.jpg';
        $image->save($manipulatedImagePath);
        
        // Cleanup: Remove the temporary file
        unlink($tempImagePath);

        // Create an invoice model and populate it with data
        $invoice = new Invoices([
            'date' => $data['date'],
            'generated_by' => $data['generatedBy'],
            'sent_to' => $data['sentTo'],
            'line_items' => $data['lineItems'],
            'invoice_number' => 123,
            'user_id' => Auth::user()->id,
        ]);

        // Generate the PDF
        $pdf = PDF::loadView('invoices.invoice_pdf', compact('invoiceData'));
        $pdf->setPaper('letter'); // You can customize the paper size if needed

        $pdfContent = $pdf->output();

        // Return the PDF as a response
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename=invoice.pdf');
    }*/
    public function store(StoreInvoicesRequest $request)
    {
        $data = $request;
        $invoiceData = $request;
        $userSettings = UserSettings::where('user_id', auth()->user()->id)->first('image');

        $imageBase64 = $userSettings->image;
        return response($imageBase64);
        // Create an invoice model and populate it with data
        $invoice = new Invoices([
            'date' => $data['date'],

            'generated_by' => $data['generatedBy'],
            'sent_to' => $data['sentTo'],
            'line_items' => $data['lineItems'],
            'invoice_number' => 123,
            'user_id' => Auth::user()->id,
        ]);


        // Save the invoice to the database (if needed)
        // $invoice->save();

        // Generate the PDF
        $pdf = PDF::loadView('invoices.invoice_pdf', compact('invoiceData'));
        $pdf->setPaper('letter'); // You can customize the paper size if needed

        $pdfContent = $pdf->output();

        // Return the PDF as a response
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename=invoice.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoicesRequest  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoicesRequest $request, Invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoices $invoices)
    {
        //
    }
}
