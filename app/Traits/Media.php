<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait Media
{

    // UPLOAD FILES and store to morph taple
    public function uploadFile($request, $groupName = 'default')
    {
        $dateTime = date('Ymd_His');
        $fileName = $dateTime . '_' . Str::random(20) . '_' . $request->getClientOriginalName();
        $request->storeAs('uploads', $fileName);
        $url = 'uploads/' . $fileName;
        return $this->images()->create([
            'name' => $fileName,
            'url'  => $url,
            'group_name' => $groupName,
        ]);
    }

    // Get FILE
    public function getFile($groupName = 'default')
    {
        return $this->images->where('group_name', $groupName)->count() > 0 ? asset($this->images->where('group_name', $groupName)->first()->url) : null;
    }

    // Get FILES
    public function getFiles($groupName = 'default')
    {
        $files = $this->images()->where('group_name', $groupName);
        return $files->count() > 0 ? $files->get(['id', 'url']) : [];
    }

    public function deleteFile($groupName = 'default')
    {
        $file = $this->images()->where('group_name', $groupName);
        if ($file->count() > 0) {
            // $filePath = str_replace('uploads/', '', $file->first()->url);
            $filePath = $file->first()->url;
            Storage::disk('uploads')->has($filePath) ? Storage::disk('uploads')
                ->delete($filePath) : '';
            return $this->images()->where('group_name', $groupName)->delete();
        }
    }

    public function deleteFiles($groupName = 'default')
    {
        $files = $this->images()->where('group_name', $groupName);
        if ($files->count() > 0) {
            foreach ($files->get() as $file) {
                $filePath = $file->url;
                Storage::disk('uploads')->has($filePath) ? Storage::disk('uploads')
                ->delete($filePath) : '';
                // $fileDelete = $file->count() > 0 ? File::delete($file->url) : '';
            }
            return $files->delete();
        }
    }
}
