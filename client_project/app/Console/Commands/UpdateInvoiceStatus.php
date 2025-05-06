<?php

namespace App\Console\Commands;

use App\Models\invoice;
use App\Models\notifications;
use App\Models\projectDetail;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateInvoiceStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update overdue status for invoices';

    /**
     * Execute the console command.
     */
        public function handle()
    {
        invoice::where('status', '!=', 'paid')->whereDate('due_date', '<', Carbon::now())->update(['status' => 'overdue']);
        $invoices = invoice::all();
        $today = now();
        foreach($invoices as $invoice) {
            if(in_array ($invoice->status, ['paid'])) {
                continue;
            }
            $dueDate =  Carbon::parse($invoice->due_date);
            $daysDiff = $today->diffInDays($dueDate, false); // false: bisa hasil negatif
            if($daysDiff < 0) {
                $overdueDays = abs($daysDiff);
                $alreadyNotified = notifications::where('user_id', $invoice->clients_id)
                    ->where('second_id', $invoice->invoice_number)
                    ->where('type', 'invoice')
                    ->where('type2', 'overdue')
                    ->exists();
                if(!$alreadyNotified) {
                    $message = "Your invoice #{$invoice->invoice_number} has passed its due date and is no longer eligible for payment. The contract is now considered void.";
                    notifications::create([
                        'user_id' => $invoice->clients_id,
                        'second_id' => $invoice->invoice_number,
                        'title' => 'Invoice overdue',
                        'type' => 'invoice',
                        'type2' => 'overdue',
                        'read' => 'no',
                        'description' => $message,
                    ]);
                    $this->info("⚠️ Overdue notification sent to user #{$invoice->clients_id} for invoice #{$invoice->invoice_number} ({$overdueDays} day(s) late).");
                }
            }
        }

        $this->info('Invoice statuses updated successfully.');
    }
}
