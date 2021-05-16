<?php

namespace App\Listeners;

use App\Events\InvoiceProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use setasign\Fpdi\Tfpdf\Fpdi;
use App\Models\Invoice;

class ExportInvoice2PDF
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  InvoiceProcessed  $event
     * @return void
     */
    public function handle(InvoiceProcessed $event)
    {
        $invoice_data = $event->invoice_data;
        $invoice = Invoice::where('order_no', $invoice_data['order_no'])->first();

        // now write some text above the imported page
        define('FPDF_FONTPATH', public_path('font'));
        $pdf = new Fpdi();

        $pdf->AddPage();
        // set the sourcefile
        $pdf->setSourceFile(storage_path('pdf/template.pdf'));
        // import page 1
        $tplIdx = $pdf->importPage(1);
        // use the imported page as the template
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->AddFont('MPLUS1p-Black', '', 'MPLUS1p-Black.ttf', true);
        $pdf->AddFont('MPLUS1p-Bold', '', 'MPLUS1p-Bold.ttf', true);
        $pdf->AddFont('MPLUS1p-ExtraBold', '', 'MPLUS1p-ExtraBold.ttf', true);
        $pdf->AddFont('MPLUS1p-Light', '', 'MPLUS1p-Light.ttf', true);
        $pdf->AddFont('MPLUS1p-Medium', '', 'MPLUS1p-Medium.ttf', true);
        $pdf->AddFont('MPLUS1p-Regular', '', 'MPLUS1p-Regular.ttf', true);
        $pdf->AddFont('MPLUS1p-Thin', '', 'MPLUS1p-Thin.ttf', true);

        // Insert a logo in the top-right corner at 300 dpi
        $pdf->Image(public_path('img/logo.png'), 130, 0, -300);

        // order no
        $pdf->SetFont('Mplus1p-Bold', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(10, 10);
        $pdf->Write(0, '#' . $invoice->order_no);

        // created at
        $pdf->SetFont('Mplus1p-Regular', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(72, 87);
        $pdf->Write(0, $invoice->created_at->format('Y-m-d'));

        // total price
        $products = collect($invoice->products);
        $total_price = $products->sum('unit_price') * $products->sum('amount');
        $pdf->SetFont('Mplus1p-Bold', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(72, 94);
        $pdf->Write(0, ('JP¥' . number_format($total_price)));

        // profile
        $pdf->SetTextColor(0, 0, 255);
        $pdf->SetFont('Mplus1p-Regular', '', 10);
        $pdf->SetXY(10, 45);
        $pdf->Write(0, 'Fullname : ' . ($invoice->fname . ' ' . $invoice->lname));

        $pdf->SetXY(10, 50);
        $pdf->Write(0, 'Email : ' . $invoice->email, $invoice->email);
        $pdf->SetXY(10, 55);
        $pdf->Write(0, 'Address : ' . $invoice->address);

        $start_pos = 118;
        foreach ($products as $product) {
            $pdf->SetFont('Mplus1p-Regular', '', 10);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(24, $start_pos);
            $pdf->Write(0, $product['name']);

            $pdf->SetXY(140, $start_pos);
            $pdf->Write(0, number_format($product['unit_price']));

            $pdf->SetXY(157, $start_pos);
            $pdf->Write(0, $product['amount']);

            $pdf->SetXY(178, $start_pos);
            $pdf->Write(0, number_format($product['unit_price'] * $product['amount']));

            $start_pos += 5;
        }

        $pdf->SetFont('Mplus1p-Bold', '', 9);
        $pdf->SetXY(172, 157);
        $pdf->Write(0, number_format($total_price));

        $pdf->Output('D', ($invoice->order_no . '.pdf'));
    }
}
