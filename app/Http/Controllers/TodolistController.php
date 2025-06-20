<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodolistController extends Controller
{
    public function todolist(){
        $tasks = Task::all();

        return view('home-template', [
            'tasks' => $tasks
        ]);
    }

    public function create(){
        return view('tambah');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'task' => 'required|min:5|max:10',
        ]);

        Task::create([
            'task'    => $validation['task'],
            'tanggal' => now()
        ]);

        return redirect('/');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/');
    }

    public function edit(Request $request)
    {
        $task = Task::find($request->id);
        return view('edit', [
            'task' => $task
        ]);
    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'task' => 'required|min:5|max:10',
        ]);

        Task::where('id', $request->id)
        ->update([
            'task' => $validation['task'],
            'tanggal' => NOW()
        ]);
        return redirect('/');
    }
    


    // public function store(Request $request){
    //     DB::table('task')->insert([
    //         'task' => $request->task
    //     ]);
        
    // }
    // public function store(Request $request){
    //     $task = new Task();
    //     $task->task = $request->task;
    //     $task->tanggal = now();
    //     $task->save();

    // }

}
