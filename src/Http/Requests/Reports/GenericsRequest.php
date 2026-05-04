<?php

namespace ProfitabilityExodus\Http\Requests\Reports;

use App\Helpers\BooleanQueryParams;
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
            'year' => 'required|date_format:' . DatesValidator::FORMAT_YEAR,
            'months' => 'required|array|min:1',
            'months.*' => 'required|integer|between:1,12',
            'laboratory' => 'nullable|string',
            'filter_only_club' => BooleanQueryParams::rule(),
            'organization_identifier' => 'nullable|string'
        ];
    }
}
