<?php

namespace ProfitabilityExodus\Http\Requests\Reports;

use Labelgrup\LaravelUtilities\Core\Requests\ApiRequest;

class FiltersRequest extends ApiRequest
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
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
            'organization_identifier' => 'nullable|string'
        ];
    }
}
