<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AdminController extends BaseController
{
    protected $adminModel;
    
    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function login()
    {
        return view('admin/login');
    }

    public function authenticate()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $admin = $this->adminModel->where('email', $email)->first();
        
        if ($admin && password_verify($password, $admin['password'])) {
            $session = session();
            $session->set([
                'id' => $admin['id'],
                'name' => $admin['name'],
                'email' => $admin['email'],
                'isLoggedIn' => true
            ]);
            
            return redirect()->to('admin');
        }
        
        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function register()
    {
        return view('admin/register');
    }

    public function createAdmin()
    {
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];

        if ($this->adminModel->insert($data)) {
            return redirect()->to('admin/admins')->with('success', 'Admin added successfully');
        }

        return redirect()->back()->with('error', 'Failed to add admin');
    }

    public function admins()
    {
        $data = [
            'title' => 'Admin Management',
            'admins' => $this->adminModel->findAll()
        ];

        return view('admin/admins/index', $data);
    }

    public function updateAdmin($id)
    {
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email')
        ];

        if ($password = $this->request->getVar('password')) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($this->adminModel->update($id, $data)) {
            return redirect()->to('admin/admins')->with('success', 'Admin updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update admin');
    }

    public function deleteAdmin($id)
    {
        if ($id == session()->get('id')) {
            return redirect()->back()->with('error', 'You cannot delete your own account');
        }

        if ($this->adminModel->delete($id)) {
            return redirect()->to('admin/admins')->with('success', 'Admin deleted successfully');
        }

        return redirect()->back()->with('error', 'Failed to delete admin');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login');
    }

    public function index()
    {
        $gameModel = new \App\Models\GameModel();
        
        $data = [
            'title' => 'Dashboard',
            'totalGames' => $gameModel->countAll(),
            'activeGames' => $gameModel->where('status', 'active')->countAllResults(),
            'totalAdmins' => $this->adminModel->countAll(),
            'recentGames' => $gameModel->orderBy('created_at', 'DESC')
                                     ->limit(5)
                                     ->find()
        ];

        return view('admin/dashboard', $data);
    }

    public function profile()
    {
        $admin = $this->adminModel->find(session()->get('id'));
        return view('admin/profile', ['admin' => $admin, 'title' => 'My Profile']);
    }

    public function updateProfile()
    {
        $id = session()->get('id');
        
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email')
        ];

        if ($password = $this->request->getVar('password')) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($this->adminModel->update($id, $data)) {
            session()->set([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
            return redirect()->back()->with('success', 'Profile updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update profile');
    }
} 