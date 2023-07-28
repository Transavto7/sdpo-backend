<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $versions = Version::orderBy('created_at', 'desc')->get();
        return view('versions.index', [
            'versions' => $versions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('versions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       if (!$request->name) {
           return back()->withErrors(['message' => 'Укажите название версии']);
       }

       if (!$request->files->has('file')) {
           return back()->withErrors(['message' => 'Выберите файл']);
       }

       $name = $request->name . '.' . $request->files->get('file')->getClientOriginalExtension();
       Storage::putFileAs('versions', $request->files->get('file'), $name);
       $path = 'versions/' . $name;
       $hash = hash_file('md5', $request->files->get('file'));


        if ($request->is_main) {
            Version::whereNotNull('is_main')->update([
                'is_main' => false,
            ]);
        }

       Version::create([
           'name' => $request->name,
           'path' => $path,
           'hash' => $hash,
           'is_main' => $request->is_main
       ]);

       return redirect(route('versions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Version $version)
    {
        return Storage::download($version->path);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Version $version)
    {
        return view('versions.edit', [
            'version' => $version
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Version $version)
    {
        if ($request->has('file')) {
            $name = $request->name . '.' . $request->files->get('file')->getClientOriginalExtension();
            Storage::putFileAs('versions', $request->files->get('file'), $name);
            $path = 'versions/' . $name;
            $hash = hash_file('md5', $request->files->get('file'));

            $version->path = $path;
            $version->hash = $hash;
        }

        if ($request->name) {
            $version->name = $request->name;
        }

        if ($request->is_main) {
            Version::whereNotNull('is_main')->update([
                'is_main' => false,
            ]);

            $version->is_main = true;
        } else {
            $version->is_main = false;
        }

        $version->save();
        return redirect(route('versions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Version $version)
    {
        $version->delete();
        return back();
    }

    public function list(Request $request) {
        return response()->json(Version::all());
    }

    public function download(Version $version)
    {
        return Storage::download($version->path);
    }
}
