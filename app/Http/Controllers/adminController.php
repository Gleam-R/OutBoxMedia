<?php

namespace App\Http\Controllers;

use App\Models\activity_logs;
use App\Models\beritas;
use App\Models\Kategori;
use App\Models\User;
use App\Models\komentar;
use App\Models\ratings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class adminController extends Controller
{
    // Show admin dashboard
    public function showDashboard(Request $request)
    {
        $beritas = beritas::with('kategori')->paginate(10);
        $users = User::all();
        $kategori = $this->getCategories();
        $logs = activity_logs::all();

        return view('berita.index', compact('kategori', 'users', 'beritas', 'logs'));
    }

    // Manage beritas with category filter
    public function manageberitas(Request $request)
    {
        $kategori_id = $request->input('kategori_id');
        $kategori = $this->getCategories();

        $beritass = beritas::when($kategori_id, function ($query) use ($kategori_id) {
            return $query->whereHas('kategoris', function ($query) use ($kategori_id) {
                $query->where('kategori_id', $kategori_id);
            });
        })
        ->paginate(10);

        return view('beritas.index', compact('beritass', 'kategori'));
    }

    // Add beritas form
    public function addberitasForm()
    {
        $kategori = $this->getCategories();
        return view('admin.tambah_beritas', compact('kategori'));
    }

// Add beritas to the database
    public function addberitas(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|array',
            'kategori_id*' => 'exists:kategoris,id',
        ]);

        $beritas = new beritas(); // Make sure this matches your model's name (Berita, not beritas)
        $beritas->judul = $validated['judul'];
        $beritas->isi = $validated['isi'];

        if ($request->hasFile('gambar')) {
            $beritas->gambar = $request->file('gambar')->store('images', 'public');
        }

        $beritas->penulis_id = Auth::user()->id;
        $beritas->save();

        $beritas->kategori()->sync($validated['kategori_id']);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }


    // Edit beritas form
    public function editberitasForm($berita_id)
    {
        $berita = beritas::findOrFail($berita_id);
        $kategori = Kategori::all();
        return view('admin.edit_beritas', compact('berita', 'kategori'));
    }

    // Edit beritas in the database
    public function editberitas(Request $request, $beritas_id)
    {
        // Validasi data input
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar tidak wajib diunggah
            'kategori_id' => 'required|array', // Pastikan kategori_id adalah array
            'kategori_id.*' => 'exists:kategoris,id', // Validasi setiap ID kategori
        ]);

        // Temukan berita berdasarkan ID
        $beritas = beritas::findOrFail($beritas_id); // Gunakan nama model yang sesuai
        $beritas->judul = $validated['judul'];
        $beritas->isi = $validated['isi'];

        // Periksa jika ada gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            $beritas->gambar = $request->file('gambar')->store('images', 'public');
        }

        // Perbarui berita di database
        $beritas->save();

        // Sinkronkan kategori ke tabel pivot
        $beritas->kategori()->sync($validated['kategori_id']);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    // Delete beritas
    public function deleteberitas($beritas_id)
    {
        $beritas = beritas::findOrFail($beritas_id);

        // Delete associated komentars (if any)
        $beritas->komentar()->delete();

        $beritas->rating()->delete();

        // Delete the berita
        $beritas->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }


    public function viewKategori()
    {
        $kategori = Kategori::all(); // Ambil semua kategori
        return view('admin.kategori.index', compact('kategori'));
    }

    // Add Category form
    public function addKategoriForm()
    {
        return view('admin.kategori.create');
    }

    // Add Category to the database
    public function addKategori(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris',
        ]);

        // Create the category
        Kategori::create([
            'nama_kategori' => $validated['nama_kategori'],
        ]);
        return redirect()->route('admin.kategoriIndex')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Edit Category form
    public function editKategoriForm($kategori_id)
    {
        $kategori = Kategori::findOrFail($kategori_id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Edit Category in the database
    public function editKategori(Request $request, $kategori_id)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori_id,
        ]);

        $kategori = Kategori::findOrFail($kategori_id);
        $kategori->nama_kategori = $validated['nama_kategori'];
        $kategori->save();

        return redirect()->route('admin.kategoriIndex')->with('success', 'Kategori berhasil diubah!');
    }
    // Delete Category
    public function deleteKategori($kategori_id)
    {
        $kategori = Kategori::findOrFail($kategori_id);
        $kategori->delete();

        return redirect()->route('admin.kategoriIndex')->with('success', 'Kategori berhasil dihapus!');
    }

    // View Activity Logs
    public function viewLogs()
    {
        $logs = activity_logs::latest()->paginate(20);
        return view('admin.logs.index', compact('logs'));
    }

    // Delete Log
    public function deleteLog($log_id)
    {
        activity_logs::destroy($log_id);

        return redirect()->route('admin.viewLogs')->with('success', 'Log berhasil dihapus!');
    }

    // View User List
    public function viewUsers()
    {
        $users = User::paginate(10); // Mengambil semua user dengan pagination
        return view('admin.user.index', compact('users'));
    }

    // Add User Form
    public function addUserForm()
    {
        return view('admin.user.create');
    }

    // Add User to the database
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User successfully added!');
    }

        // Edit User Form
    public function editUserForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

        // Edit User in the database
     public function editUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:user,admin',
        ]);
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->role = $request->role;

            $user->save();

            return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate!');
    }



    // Delete User
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User successfully deleted!');
    }

    // Helper method to get categories
    protected function getCategories()
    {
        return Kategori::all();
    }
}
