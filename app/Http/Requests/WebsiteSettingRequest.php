<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteSettingRequest extends FormRequest
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
            'website_title'         => 'required|string|max:255',
            'website_tag_title'     => 'nullable|string|max:255',
            // 'website_logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'website_favicon'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'website_footer_logo'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_one'             => 'nullable|string|max:15',
            'phone_two'             => 'nullable|string|max:15',
            'email_one'             => 'nullable|email|max:255',
            'email_two'             => 'nullable|email|max:255',
            'address_one'           => 'nullable|string|max:255',
            'address_two'           => 'nullable|string|max:255',
            'footer_copyright_text' => 'nullable|string|max:255',
        ];

    }
}
