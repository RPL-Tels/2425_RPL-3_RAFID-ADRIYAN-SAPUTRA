<?php

namespace App\Console\Commands;

use App\Models\invoice;
use App\Models\notifications;
use Carbon\Carbon;
use Illuminate\Console\Command;


class CheckInvoiceDueDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:check-due-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for invoices nearing due date and notify clients';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $validStatuses = ['unpaid', 'pending', 'processing']; // hanya ini yang akan dicek

        $today = Carbon::today();

        $invoices = Invoice::all();
        
        foreach ($invoices as $invoice) {
            if (!in_array($invoice->status, $validStatuses)) {
                continue;
            }
            $dueDate = Carbon::parse($invoice->due_date);
            $daysDiff = $today->diffInDays($dueDate, false); // false = bisa negatif (overdue)

            $message = null;

            if ($daysDiff === 7) {
                $message = "Reminder: Your invoice {$invoice->invoice_number} is due in 7 days on {$dueDate->format('M d Y')}.";
            } elseif ($daysDiff === 2) {
                $message = "Reminder: Your invoice {$invoice->invoice_number} is due in 2 days on {$dueDate->format('M d Y')}.";
            } elseif ($daysDiff === 1) {
                $message = "Urgent: Your invoice {$invoice->invoice_number} is due tomorrow ({$dueDate->format('M d Y')}).";
            } elseif ($daysDiff === 0) {
                $message = "Important: Your invoice {$invoice->invoice_number} is due today ({$dueDate->format('M d Y')}). Please complete your payment.";
            } elseif ($daysDiff < 0) {
                $overdueDays = abs($daysDiff);
                $message = "Alert: Your invoice #{$invoice->invoice_number} is overdue by {$overdueDays} day(s). Please settle the payment immediately.";
            }

            if ($message) {
                notifications::create([
                    'user_id' => $invoice->clients_id,
                    'second_id' => $invoice->invoice_number,
                    'third_id' => $invoice->project_id,
                    'title' => 'Payment bill',
                    'description' => $message,
                    'type' => 'invoice',
                    'type2' => 'pending',
                    'read' => 'no'
                ]);
                $this->info("wow.");
            }
        }

        return Command::SUCCESS;
    }
}
