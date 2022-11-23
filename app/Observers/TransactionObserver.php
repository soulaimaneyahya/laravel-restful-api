<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    public function creating(Transaction $transaction)
    {
        $today = date('Ymd');
        $transactionsToday = Transaction::where('transaction_no', 'like', "{$today}%")->pluck('transaction_no');
        do {
            $transactionNo = $today . rand(10000, 99999);
        } while ($transactionsToday->contains($transactionNo));
        $transaction->transaction_no = $transactionNo;
    }
}
