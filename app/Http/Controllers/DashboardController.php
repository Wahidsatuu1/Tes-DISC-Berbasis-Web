<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscResult;
use App\Models\InternBiodata;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $resultsQuery = DiscResult::with('biodata')->latest();
        
        if (!empty($search)) {
            $resultsQuery->whereHas('biodata', function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('no_identitas', 'like', "%{$search}%")
                      ->orWhere('universitas', 'like', "%{$search}%")
                      ->orWhere('fakultas', 'like', "%{$search}%");
            });
        }
        
        $results = $resultsQuery->paginate(10)->withQueryString();
        
        // Calculate statistics for all results (distribution of dominant personalities)
        $allResults = DiscResult::all();
        $totalTests = $allResults->count();
        
        $dominants = ['D' => 0, 'I' => 0, 'S' => 0, 'C' => 0];
        
        foreach ($allResults as $res) {
            $scores = [
                'D' => $res->score_d_change,
                'I' => $res->score_i_change,
                'S' => $res->score_s_change,
                'C' => $res->score_c_change,
            ];
            // Sort by score descending
            arsort($scores);
            $dominant = key($scores);
            if (array_key_exists($dominant, $dominants)) {
                $dominants[$dominant]++;
            }
        }
        
        return view('dashboard', compact('results', 'totalTests', 'dominants', 'search'));
    }
}
