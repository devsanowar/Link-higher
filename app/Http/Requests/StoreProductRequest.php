<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_category_id' => 'required|exists:product_categories,id',
            'product_name'   => 'required|string|max:255',
            'website_url'    => 'nullable|url|max:255',
            'price'          => 'nullable|numeric|min:0',
            'ahrefs_dr'      => 'nullable|integer|min:0',
            'moz_da'         => 'nullable|integer|min:0',
            'moz_pa'         => 'nullable|integer|min:0',
            'traffic'        => 'nullable|integer|min:0',
            'target_country' => 'nullable|string|max:100',
            'product_description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'news'         => 'required|in:0,1',
            'status'         => 'required|in:0,1',
        ];
    }
}
