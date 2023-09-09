<?php

namespace Modules\Isite\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateModuleRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }

    public function getValidator()
    {
        return $this->getValidatorInstance();
    }
}