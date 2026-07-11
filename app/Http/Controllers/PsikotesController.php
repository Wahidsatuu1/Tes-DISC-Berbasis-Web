<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\InternBiodata;
use App\Models\DiscQuestion;
use App\Models\DiscOption;
use App\Models\DiscResult;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class PsikotesController extends Controller
{
    public function index()
    {
        $questions = DiscQuestion::with('options')->get();
        return view('psikotes.index', compact('questions'));
    }

    public function submit(Request $request)
    {
        DB::beginTransaction();
        try {
            // 1. Simpan Biodata
            $biodata = InternBiodata::create([
                'nama_lengkap' => $request->input('nama_lengkap'),
                'no_identitas' => $request->input('no_identitas'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'fakultas' => $request->input('fakultas') ?? '-',
                'semester' => $request->input('semester') ?? '-',
                'universitas' => $request->input('universitas') ?? '-',
                'alamat' => $request->input('alamat'),
                'no_telepon' => $request->input('no_telepon'),
                'nama_orang_tua' => $request->input('nama_orang_tua'),
                'pekerjaan_orang_tua' => $request->input('pekerjaan_orang_tua') ?? '-',
                'alamat_orang_tua' => $request->input('alamat_orang_tua'),
                'no_telepon_orang_tua' => $request->input('no_telepon_orang_tua'),
                'pembimbing' => $request->input('pembimbing') ?? '-',
                'no_telepon_pembimbing' => $request->input('no_telepon_pembimbing') ?? '-',
                'durasi_magang' => $request->input('durasi_magang') ?? '-',
                'mulai' => $request->input('mulai') ?? date('Y-m-d'),
                'sampai' => $request->input('sampai') ?? date('Y-m-d'),
            ]);

            // 2. Proses Jawaban DISC
            $scores = [
                'most' => ['D' => 0, 'I' => 0, 'S' => 0, 'C' => 0, '*' => 0],
                'least' => ['D' => 0, 'I' => 0, 'S' => 0, 'C' => 0, '*' => 0],
            ];

            $answersData = [];

            for ($i = 1; $i <= 24; $i++) {
                $mostOptionId = $request->input("most_$i");
                $leastOptionId = $request->input("least_$i");

                if ($mostOptionId && $leastOptionId) {
                    $mostOption = DiscOption::find($mostOptionId);
                    $leastOption = DiscOption::find($leastOptionId);

                    if ($mostOption) $scores['most'][$mostOption->most_type]++;
                    if ($leastOption) $scores['least'][$leastOption->least_type]++;

                    $answersData[$i] = [
                        'most' => $mostOptionId,
                        'least' => $leastOptionId
                    ];
                }
            }

            // Hitung Perubahan (Change)
            $changeD = $scores['most']['D'] - $scores['least']['D'];
            $changeI = $scores['most']['I'] - $scores['least']['I'];
            $changeS = $scores['most']['S'] - $scores['least']['S'];
            $changeC = $scores['most']['C'] - $scores['least']['C'];

            // 3. Simpan Hasil DISC
            $result = DiscResult::create([
                'intern_biodata_id' => $biodata->id,
                'user_id' => Auth::id(), // null jika belum login
                'answers' => json_encode($answersData),
                'score_d_most' => $scores['most']['D'],
                'score_i_most' => $scores['most']['I'],
                'score_s_most' => $scores['most']['S'],
                'score_c_most' => $scores['most']['C'],
                'score_star_most' => $scores['most']['*'],
                'score_d_least' => $scores['least']['D'],
                'score_i_least' => $scores['least']['I'],
                'score_s_least' => $scores['least']['S'],
                'score_c_least' => $scores['least']['C'],
                'score_star_least' => $scores['least']['*'],
                'score_d_change' => $changeD,
                'score_i_change' => $changeI,
                'score_s_change' => $changeS,
                'score_c_change' => $changeC,
            ]);

            $resultId = $result->id;

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data psikotes berhasil disimpan!',
                'result_id' => $resultId
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function exportPdf($id)
    {
        $result = DiscResult::find($id);
        if (!$result) abort(404);

        $biodata = InternBiodata::find($result->intern_biodata_id);

        $pdf = Pdf::loadView('psikotes.pdf', compact('result', 'biodata'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Hasil_Psikotes_DISC.pdf');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $result = DiscResult::find($id);
            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data hasil tes tidak ditemukan.'
                ], 404);
            }

            // Hapus biodata terkait
            if ($result->intern_biodata_id) {
                InternBiodata::destroy($result->intern_biodata_id);
            }

            $result->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Hasil tes psikotes berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
