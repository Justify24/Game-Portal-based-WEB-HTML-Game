<?php

namespace App\Controllers;

use App\Models\GameModel;
use CodeIgniter\Files\File;

class GameController extends BaseController
{
    protected $gameModel;
    protected $session;

    public function __construct()
    {
        $this->gameModel = new GameModel();
        $this->session = session();
    }

    public function index()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Game Management',
            'games' => $this->gameModel->findAll()
        ];

        return view('admin/games/index', $data);
    }

    public function new()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Add New Game'
        ];

        return view('admin/games/form', $data);
    }

    public function create()
    {
        try {
            $cover = $this->request->getFile('cover');
            
            if (!$cover->isValid() || $cover->hasMoved()) {
                return redirect()->back()->with('error', 'Please select a valid image file');
            }

            // Buat direktori jika belum ada
            $uploadPath = 'uploads/covers';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $coverName = $cover->getRandomName();
            if ($cover->move($uploadPath, $coverName)) {
                $data = [
                    'title' => $this->request->getVar('title'),
                    'description' => $this->request->getVar('description'),
                    'embed_url' => $this->request->getVar('embed_url'),
                    'cover_url' => $uploadPath . '/' . $coverName,  // Simpan path relatif
                    'how_to_play' => $this->request->getVar('how_to_play'),
                    'status' => $this->request->getVar('status') ?? 'active'
                ];

                if ($this->gameModel->insert($data)) {
                    return redirect()->to('admin/games')->with('success', 'Game berhasil ditambahkan');
                }
            }

            // Hapus file jika gagal
            if (file_exists($uploadPath . '/' . $coverName)) {
                unlink($uploadPath . '/' . $coverName);
            }
            
            return redirect()->back()->with('error', 'Failed to add game');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id = null)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $game = $this->gameModel->find($id);
        if (!$game) {
            return redirect()->to('/admin/games')->with('error', 'Game tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Game',
            'game' => $game
        ];

        return view('admin/games/form', $data);
    }

    public function update($id = null)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $rules = [
            'title' => 'required|min_length[3]',
            'description' => 'required',
            'embed_url' => 'required'
        ];

        if ($this->request->getFile('cover')->isValid()) {
            $rules['cover'] = [
                'rules' => 'max_size[cover,2048]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png,image/webp]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar (max 2MB)',
                    'is_image' => 'File yang dipilih bukan gambar',
                    'mime_in' => 'File harus berformat JPG, PNG, atau WebP'
                ]
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'embed_url' => $this->request->getPost('embed_url'),
            'how_to_play' => $this->request->getPost('how_to_play'),
            'status' => $this->request->getPost('status')
        ];

        $cover = $this->request->getFile('cover');
        if ($cover->isValid() && !$cover->hasMoved()) {
            $coverName = $cover->getRandomName();
            
            try {
                $cover->move(FCPATH . 'uploads/covers', $coverName);
                $data['cover_url'] = '/uploads/covers/' . $coverName;

                $oldGame = $this->gameModel->find($id);
                if ($oldGame && $oldGame['cover_url']) {
                    $oldCoverPath = FCPATH . ltrim($oldGame['cover_url'], '/');
                    if (file_exists($oldCoverPath)) {
                        unlink($oldCoverPath);
                    }
                }
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar: ' . $e->getMessage());
            }
        }

        if ($this->gameModel->update($id, $data)) {
            return redirect()->to('/admin/games')->with('success', 'Game berhasil diperbarui');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui game');
    }

    public function delete($id = null)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $game = $this->gameModel->find($id);
        if ($game) {
            // Hapus file cover jika ada
            if ($game['cover_url']) {
                $file = str_replace(base_url(), FCPATH, $game['cover_url']);
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            if ($this->gameModel->delete($id)) {
                return redirect()->to('/admin/games')->with('success', 'Game berhasil dihapus');
            }
        }

        return redirect()->to('/admin/games')->with('error', 'Gagal menghapus game');
    }
} 