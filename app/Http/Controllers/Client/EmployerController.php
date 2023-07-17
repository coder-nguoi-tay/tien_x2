<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Employer;
use App\Models\location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('client.employer.register', [
            'location' => $this->getlocation()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $this->convertName($request->name);
        if (!$this->checkMailUser($request)) {
            $this->setFlash(__('Email này đã được đăng ký trước đây'), 'error');
            return view('client.employer.register', [
                'location' => $this->getlocation(),
                'request' => $request->all(),
            ]);
        }
        try {
            $user =  User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2,
                'status' => 2,
                'slug' => $name
            ]);
            $user->save();
            $employer = new Employer();
            $employer->name = $request->name;
            $employer->phone = $request->sdt;
            $employer->sex = $request->sex;
            $employer->namecompany = $request->company;
            $employer->workplace = $request->workplace;
            $employer->address = $request->address;
            $employer->user_id = $user->id;
            $employer->save();
            $this->setFlash(__('đăng ký tài khoản nhà tuyển dụng thành công'));
            return redirect(route('home'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            $this->setFlash(__('đã có một lỗi không xác định đã xảy ra, kiểm tra lại thông tin của bạn'), 'error');
            return view('client.employer.register', [
                'location' => $this->getlocation(),
                'request' => $request->all(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
