<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeroSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'button_one'        => ['nullable', 'string', 'max:255'],
            'button_one_url'    => ['nullable', 'url', 'max:2048'],
            'button_two'        => ['nullable', 'string', 'max:255'],
            'button_two_url'    => ['nullable', 'url', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [

            // Title
            'title.required'             => 'Hero title is required.',
            'title.string'               => 'Hero title must be a valid text value.',
            'title.max'                  => 'Hero title cannot exceed 255 characters.',

            // Short Description
            'short_description.required' => 'A short description is required.',
            'short_description.string'   => 'Short description must be valid text.',

            // Image
            'image.image'                => 'The uploaded file must be an image.',
            'image.mimes'                => 'Only JPG, JPEG, PNG, or WEBP image formats are allowed.',
            'image.max'                  => 'Image size should not exceed 2MB.',

            // Button One
            'button_one.string'          => 'Button One text must be valid text.',
            'button_one.max'             => 'Button One text cannot exceed 255 characters.',
            'button_one_url.url'         => 'Button One URL must be a valid URL.',

            // Button Two
            'button_two.string'          => 'Button Two text must be valid text.',
            'button_two.max'             => 'Button Two text cannot exceed 255 characters.',
            'button_two_url.url'         => 'Button Two URL must be a valid URL.',
        ];
    }

}
