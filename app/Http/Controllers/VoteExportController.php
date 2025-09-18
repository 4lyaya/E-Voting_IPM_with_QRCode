<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Mpdf\Mpdf;

class VoteExportController extends Controller
{
    public function exportVoteResult()
    {
        // Hitung perolehan suara tiap kandidat
        $results = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        $totalVotes = Vote::count();

        $html = view('admin.votes.export-pdf', compact('results', 'totalVotes'))->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
        ]);

        $mpdf->WriteHTML($html);

        // Langsung download
        return $mpdf->Output('hasil-vote.pdf', 'D');
    }
}