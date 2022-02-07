<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $indexView = 'message.index';
    protected $createView = 'message.create';
    protected $showView = 'message.show';
    protected $editView = 'message.edit';
    protected $confirmView = 'message.confirm';

    public function index()
    {
        // $messages = Message::latest()->get();

        return view($this->indexView);
    }


    public function create()
    {
        return view($this->createView);
    }


    public function store(Request $request)
    {
        if ($request->submit == 'draft') {
            $request->validate([
                'first_name' => 'required_without_all:last_name,vaccine_name,vaccinated_date,age',
                'last_name' => 'required_without_all:first_name,vaccine_name,vaccinated_date,age',
                'vaccine_name' => 'required_without_all:first_name,last_name,vaccinated_date,age',
                'vaccinated_date' => 'required_without_all:last_name,vaccine_name,first_name,age',
                'age' => 'required_without_all:last_name,vaccine_name,vaccinated_date,first_name',
            ]);

            $input = $request->all();
            $security_code = Message::getSecurityCode();
            // dd($security_code);
            $input['security_code'] = $security_code;
            Message::create($input);
        } else {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'vaccine_name' => 'required',
                'vaccinated_date' => 'required',
                'age' => 'required',
            ]);

            $input = $request->all();
            $security_code = Message::getSecurityCode();
            // dd($security_code);
            $input['security_code'] = $security_code;
            $input['submitted'] = 1;
            Message::create($input);
        }

        return redirect()
            ->route('message.index')
            ->with('msg', 'Message Saved. Your code is ' . $security_code . '.');
    }


    public function show(Message $message)
    {
        return view($this->showView, compact('message'));
    }


    public function edit(Message $message)
    {
        return view($this->editView, compact('message'));
    }


    public function update(Request $request, Message $message)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'vaccine_name' => 'required',
            'vaccinated_date' => 'required',
            'age' => 'required',
        ]);

        $input = $request->all();
        $input['submitted'] = 1;
        $message->update($input);
        return redirect()
            ->route('message.index')
            ->with('msg', 'Message Saved.');
    }

    public function showMessageAuth(Message $message)
    {
        return view($this->confirmView, compact('message'));
    }

    public function messageAuth(Request $request, Message $message)
    {
        if ($request->security_code == $message->security_code) {
            session()->put('message-' . $message->id, 1);
            if($message->submitted == 0){
                return redirect()->route('message.edit', $message->id);
            }else{
                return redirect()->route('message.show', $message->id);
            }

        } else {
            return redirect()->back()->with('msg', 'confirmation code did not match');
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|integer',
        ]);

        $keyword = $request->keyword;
        $result = Message::where('security_code', $keyword)->first();

        if($result){
            if($result->submitted == 1){
                return redirect()->route('message.show', $result->id);
            }else{
                return redirect()->route('message.edit', $result->id);
            }
        }else{
            return redirect()->back()->with('msg', $keyword.' did not match with any record.');
        }
    }
}
