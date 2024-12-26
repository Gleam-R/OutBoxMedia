<?php

namespace App\Http\Controllers;

use App\Models\activity_logs;
use App\Models\beritas;
use App\Models\komentar;
use App\Models\ratings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class userController extends Controller
{
        /**
         * Menampilkan daftar berita.
         */
        public function index()
        {
            // Logic untuk mengambil berita (contoh sederhana)
            $beritas = beritas::with('kategori')->paginate(10);
            return view('berita.index', compact('beritas'));
        }

        /**
         * Menampilkan detail berita.
         */
        public function show($id)
        {
            $berita = beritas::with(['komentar.user', 'rating.user'])->findOrFail($id);
            return view('berita.show', compact('berita'));
        }

        /**
         * Menambahkan komentar.
         */
        public function addComment(Request $request, $id)
        {
            $validated = $request->validate([
                'komentar' => 'required|string|max:500',
            ]);

            Komentar::create([
                'user_id' => Auth::id(),
                'berita_id' => $id,
                'komentar' => $validated['komentar'],
            ]);

            activity_logs::create([
                'user_id' => Auth::id(),
                'activities' => 'Memberikan Rating '. $request->komentar . 'pada berita ' . beritas::find($id)->judul,
            ]);

            return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
        }

        /**
         * Menambahkan rating.
         */public function addRating(Request $request, $id)
            {
                // Validasi input rating
                $validated = $request->validate([
                    'rating' => 'required|integer|between:1,5',
                ]);

                // Cek apakah pengguna sudah memberikan rating pada berita ini
                $existingRating = ratings::where('user_id', Auth::id())
                    ->where('berita_id', $id)
                    ->first();

                if ($existingRating) {
                    return redirect()->back()->with('error', 'Anda sudah memberikan rating untuk berita ini.');
                }

                // Tambahkan rating baru
                ratings::create([
                    'user_id' => Auth::id(),
                    'berita_id' => $id, // Gunakan $id sebagai berita_id
                    'rating' => $validated['rating'],
                ]);

                activity_logs::create([
                    'user_id' => Auth::id(),
                    'activities' => 'Memberikan Rating '. $request->rating . 'pada berita ' . beritas::find($id)->judul,
                ]);

                return redirect()->back()->with('success', 'Rating berhasil ditambahkan!');
            }
        /**
         * Mencatat aktivitas pengguna ke dalam activity log.
         */
        protected function logActivity($activity)
        {
            $activity_log = activity_logs::with('user')->get();
            return view('admin.logs.index', compact('logActivities'));
        }
}
