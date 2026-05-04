<?php

namespace ProfitabilityExodus\Http\Requests\Generics;

use Labelgrup\LaravelUtilities\Core\Requests\ApiRequest;

class DetailRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'organization_identifier' => 'nullable|string'
        ];
    }
}
