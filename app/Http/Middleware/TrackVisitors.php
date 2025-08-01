<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackVisitors
{
    public function handle(Request $request, Closure $next): Response
    {
        // Hindari melacak kunjungan dari bot/crawler umum
        $bots = ['bot', 'crawler', 'spider', 'crawling'];
        foreach ($bots as $bot) {
            if (str_contains(strtolower($request->userAgent()), $bot)) {
                return $next($request); // Lewati jika ini bot
            }
        }
        
        // Hindari melacak route admin panel
        if ($request->is('admin/*') || $request->is('login') || $request->is('register')) {
            return $next($request);
        }

        $ip = $request->ip();
        $today = Carbon::today()->toDateString();

        // Cari visitor unik berdasarkan IP dan tanggal hari ini
        $visitor = Visitor::where('ip_address', $ip)
                          ->where('visit_date', $today)
                          ->first();

        if ($visitor) {
            // Jika ada, ini bukan unique visit, cukup tambahkan total kunjungannya
            $visitor->increment('visits');
        } else {
            // Jika tidak ada, ini adalah unique visit, buat record baru
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'visit_date' => $today,
            ]);
        }

        return $next($request);
    }
}