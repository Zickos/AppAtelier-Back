<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Http\Resources\PhotoResource;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Liste toutes les photos avec leur retrofit associé.
     */
    public function index()
    {
        $photos = Photo::with('retrofit')->get();
        return PhotoResource::collection($photos);
    }

    /**
     * Crée une nouvelle photo avec upload.
     */
    public function store(PhotoRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // 🛡️ Vérification MIME réelle
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $realMime = finfo_file($finfo, $file->getPathname());
            finfo_close($finfo);

            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($realMime, $allowedMimes)) {
                return response()->json(['message' => 'Format d’image non autorisé.'], 422);
            }

            // ✅ Renommage + stockage
            $filename = uniqid('photo_') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('photos', $filename, 'public');
            $url = Storage::url($path);
        } else {
            return response()->json(['message' => 'Image manquante.'], 422);
        }

        $photo = Photo::create([
            'url' => $url,
            'commentaire' => $request->commentaire,
            'retrofit_id' => $request->retrofit_id,
        ]);

        return new PhotoResource($photo->load('retrofit'));
    }
    /**
     * Affiche une photo spécifique.
     */
    public function show(Photo $photo)
    {
        return new PhotoResource($photo->load('retrofit'));
    }

    /**
     * Met à jour une photo existante, avec nouvel upload si fourni.
     */
    public function update(PhotoRequest $request, Photo $photo)
    {
        $data = $request->only('commentaire', 'retrofit_id');

        // ✅ Si nouvelle image, remplace l’ancienne
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // 🛡️ Vérification MIME réelle
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $realMime = finfo_file($finfo, $file->getPathname());
            finfo_close($finfo);

            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($realMime, $allowedMimes)) {
                return response()->json(['message' => 'Format d’image non autorisé.'], 422);
            }

            // ✅ Renommage + stockage
            $filename = uniqid('photo_') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('photos', $filename, 'public');
            $url = Storage::url($path);
        } else {
            return response()->json(['message' => 'Image manquante.'], 422);
        }

        $photo->update($data);

        return new PhotoResource($photo->load('retrofit'));
    }

    /**
     * Supprime une photo.
     */
    public function destroy(Photo $photo)
    {
        // 🔥 Supprimer le fichier physique
        if ($photo->url) {
            $path = str_replace('/storage/', '', $photo->url);
            Storage::disk('public')->delete($path);
        }

        $photo->delete();

        return response()->json(null, 204);
    }
}
