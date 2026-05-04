<?php

namespace ProfitabilityExodus\Http\Requests\Discounts;

use App\Services\Exodus\src\Validators\DatesValidator;
use Labelgrup\LaravelUtilities\Core\Requests\ApiRequest;

class GenericsRequest extends ApiRequest
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
            'search_query' => 'nullable|string',
            'from_month' => 'required|date|date_format:' . DatesValidator::FORMAT_YEAR_MONTH,
            'to_month' => 'required|date|date_format:' . DatesValidator::FORMAT_YEAR_MONTH . '|after_or_equal:from',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
            'organization_identifier' => 'nullable|string'
        ];
    }
}
