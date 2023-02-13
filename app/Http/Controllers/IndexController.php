<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailNotificationRequest;
use App\Repository\EmailNotificationRepository;
use App\Repository\SymbolDataRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function fetchData(): Response
    {
        $chartData = (new SymbolDataRepository())->getChartData();

        return response(compact('chartData'));
    }

    public function createEmailNotification(EmailNotificationRequest $request): RedirectResponse
    {
        try {
            $emailNotificationRepo = new EmailNotificationRepository();
            $emailNotificationRepo->saveEmailNotification($request->validated());
        } catch (\Exception $exception) {
            Log::error($exception);

            return redirect('dashboard')->with('status', 'error');
        }


        return redirect('dashboard')->with('status', 'success');
    }
}
