<?php

namespace App\Http\Controllers;

use App\Jobs\MailSend;
use App\Models\Product;
use Illuminate\Http\Request;

class TestQueueEmails extends Controller
{
    public function sendTestEmails()
    {
        $emailJobs = new MailSend();
        $this->dispatch($emailJobs);
        Product::create([
            "name" => "home",
            "user_id" => 1
        ]);
        return "sucessfully sent test emails";
    }
}
