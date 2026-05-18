<?php
namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'video'       => 'nullable|mimes:mp4,mov,avi,webm|max:10240',
            'date'        => 'nullable|date|after_or_equal:now',
            'address'     => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'rules'       => 'nullable|string',
            'status'      => 'boolean',
            'chat_available' => 'boolean',
            'is_private' => 'boolean',

            'latitude'    => 'nullable|numeric|between:-90,90',
            'longitude'   => 'nullable|numeric|between:-180,180',
            // Organizers validation
            'organizers'   => 'nullable|array',
            'organizers.*' => 'exists:users,id',
            // Sponsors validation
            'sponsors'      => 'nullable|array',
            'sponsors.*.id' => 'sometimes|string|exists:event_sponsors,id',
            'sponsors.*.name' => 'required|string|max:255',
            'sponsors.*.image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Users validation
            'event_users'   => 'nullable|array',
            'event_users.*' => 'exists:users,id',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The event title is required.',
            'image.image'    => 'The image must be a valid image file.',
            'image.max'      => 'The image must be less than 2MB.',
            'video.max'      => 'The video must be less than 10MB.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
            'date.after_or_equal' => 'Event date cannot be in the past.',
        ];
    }
}
