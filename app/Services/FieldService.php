<?php

namespace App\Services;

use App\Models\Field;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FieldService
{
    /**
     * Upload photo with custom name.
     */
    public static function uploadPhoto(UploadedFile $file, string $fieldName): string
    {
        $date = now()->format('Y-m-d');
        $extension = $file->getClientOriginalExtension();
        $filename = "photo-{$fieldName}-{$date}.{$extension}";
        return $file->storeAs('fields', $filename, 'public');
    }

    /**
     * Create a new field with optional photo upload.
     */
    public static function createField(array $data, ?UploadedFile $photo = null): Field
    {
        if ($photo) {
            $data['photo'] = self::uploadPhoto($photo, $data['name']);
        }

        return Field::create($data);
    }

    /**
     * Update an existing field with optional photo upload.
     */
    public static function updateField(Field $field, array $data, ?UploadedFile $photo = null): Field
    {
        if ($photo) {
            // Delete old photo if exists
            if ($field->photo) {
                Storage::disk('public')->delete($field->photo);
            }
            $data['photo'] = self::uploadPhoto($photo, $data['name']);
        }

        $field->update($data);
        return $field;
    }

    /**
     * Delete a field and its photo.
     */
    public static function deleteField(Field $field): bool
    {
        if ($field->photo) {
            Storage::disk('public')->delete($field->photo);
        }
        return $field->delete();
    }
}
