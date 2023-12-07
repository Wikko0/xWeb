<?php

return [
    'accepted' => ':attribute трябва да бъде приет.',
    'active_url' => ':attribute не е валиден URL.',
    'after' => ':attribute трябва да бъде дата след :date.',
    'after_or_equal' => ':attribute трябва да бъде дата след или равна на :date.',
    'alpha' => ':attribute трябва да съдържа само букви.',
    'alpha_dash' => ':attribute трябва да съдържа само букви, цифри, тирета и подчертавки.',
    'alpha_num' => ':attribute трябва да съдържа само букви и цифри.',
    'array' => ':attribute трябва да бъде масив.',
    'before' => ':attribute трябва да бъде дата преди :date.',
    'before_or_equal' => ':attribute трябва да бъде дата преди или равна на :date.',
    'between' => [
        'numeric' => ':attribute трябва да бъде между :min и :max.',
        'file' => ':attribute трябва да бъде между :min и :max килобайта.',
        'string' => ':attribute трябва да бъде между :min и :max знака.',
        'array' => ':attribute трябва да има между :min и :max елемента.',
    ],
    'boolean' => 'Полето :attribute трябва да бъде true или false.',
    'confirmed' => 'Полето :attribute не съответства на потвърждението.',
    'date' => ':attribute не е валидна дата.',
    'date_equals' => ':attribute трябва да бъде дата, равна на :date.',
    'date_format' => ':attribute не съответства на формата :format.',
    'different' => ':attribute и :other трябва да са различни.',
    'digits' => ':attribute трябва да има :digits цифри.',
    'digits_between' => ':attribute трябва да има между :min и :max цифри.',
    'dimensions' => ':attribute има невалидни размери на изображението.',
    'distinct' => 'Полето :attribute има дублираща стойност.',
    'email' => ':attribute трябва да бъде валиден имейл адрес.',
    'ends_with' => ':attribute трябва да завършва с една от следните стойности: :values.',
    'enum' => ':attribute има невалидна стойност.',
    'exists' => 'Избраното :attribute е невалидно.',
    'file' => ':attribute трябва да бъде файл.',
    'filled' => 'Полето :attribute е задължително.',
    'gt' => [
        'numeric' => ':attribute трябва да бъде по-голямо от :value.',
        'file' => ':attribute трябва да бъде по-голямо от :value килобайта.',
        'string' => ':attribute трябва да бъде по-голямо от :value знака.',
        'array' => ':attribute трябва да има повече от :value елемента.',
    ],
    'gte' => [
        'numeric' => ':attribute трябва да бъде по-голямо или равно на :value.',
        'file' => ':attribute трябва да бъде по-голямо или равно на :value килобайта.',
        'string' => ':attribute трябва да бъде по-голямо или равно на :value знака.',
        'array' => ':attribute трябва да има :value елемента или повече.',
    ],
    'image' => ':attribute трябва да бъде изображение.',
    'in' => 'Избраното :attribute е невалидно.',
    'in_array' => 'Полето :attribute не съществува в :other.',
    'integer' => ':attribute трябва да бъде цяло число.',
    'ip' => ':attribute трябва да бъде валиден IP адрес.',
    'ipv4' => ':attribute трябва да бъде валиден IPv4 адрес.',
    'ipv6' => ':attribute трябва да бъде валиден IPv6 адрес.',
    'json' => ':attribute трябва да бъде валиден JSON формат.',
    'lowercase' => ':attribute трябва да бъде с малки букви.',
    'lt' => [
        'numeric' => ':attribute трябва да бъде по-малко от :value.',
        'file' => ':attribute трябва да бъде по-малко от :value килобайта.',
        'string' => ':attribute трябва да бъде по-малко от :value знака.',
        'array' => ':attribute трябва да има по-малко от :value елемента.',
    ],
    'lte' => [
        'numeric' => ':attribute трябва да бъде по-малко или равно на :value.',
        'file' => ':attribute трябва да бъде по-малко или равно на :value килобайта.',
        'string' => ':attribute трябва да бъде по-малко или равно на :value знака.',
        'array' => ':attribute трябва да има :value елемента или по-малко.',
    ],
    'mac_address' => ':attribute трябва да бъде валиден MAC адрес.',
    'max' => [
        'numeric' => ':attribute не трябва да бъде по-голямо от :max.',
        'file' => ':attribute не трябва да бъде по-голямо от :max килобайта.',
        'string' => ':attribute не трябва да бъде по-голямо от :max знака.',
        'array' => ':attribute не трябва да има повече от :max елемента.',
    ],
    'max_digits' => ':attribute не трябва да има повече от :max цифри.',
    'mimes' => ':attribute трябва да бъде файл от тип: :values.',
    'mimetypes' => ':attribute трябва да бъде файл от тип: :values.',
    'min' => [
        'array' => ':attribute трябва да има поне :min елемента.',
        'file' => ':attribute трябва да бъде поне :min килобайта.',
        'numeric' => ':attribute трябва да бъде поне :min.',
        'string' => ':attribute трябва да бъде поне :min знака.',
    ],
    'min_digits' => ':attribute трябва да има поне :min цифри.',
    'missing' => 'Полето :attribute трябва да бъде празно.',
    'missing_if' => 'Полето :attribute трябва да бъде празно, когато :other е :value.',
    'missing_unless' => 'Полето :attribute трябва да бъде празно, освен ако :other не е :value.',
    'missing_with' => 'Полето :attribute трябва да бъде празно, когато :values са налични.',
    'missing_with_all' => 'Полето :attribute трябва да бъде празно, когато всички :values са налични.',
    'multiple_of' => ':attribute трябва да бъде кратно на :value.',
    'not_in' => 'Избраното :attribute е невалидно.',
    'not_regex' => 'Форматът на :attribute е невалиден.',
    'numeric' => ':attribute трябва да бъде число.',
    'password' => [
        'letters' => ':attribute трябва да съдържа поне една буква.',
        'mixed' => ':attribute трябва да съдържа поне една главна и една малка буква.',
        'numbers' => ':attribute трябва да съдържа поне една цифра.',
        'symbols' => ':attribute трябва да съдържа поне един символ.',
        'uncompromised' => ':attribute е възможно да се открие в данните от утечка. Моля, изберете различен :attribute.',
    ],
    'present' => 'Полето :attribute трябва да бъде налично.',
    'prohibited' => 'Полето :attribute е забранено.',
    'prohibited_if' => 'Полето :attribute е забранено, когато :other е :value.',
    'prohibited_unless' => 'Полето :attribute е забранено, освен ако :other не е сред :values.',
    'prohibits' => 'Полето :attribute забранява на :other да бъде налично.',
    'regex' => 'Форматът на :attribute е невалиден.',
    'required' => 'Полето :attribute е задължително.',
    'required_array_keys' => 'Полето :attribute трябва да съдържа ключове за: :values.',
    'required_if' => 'Полето :attribute е задължително, когато :other е :value.',
    'required_if_accepted' => 'Полето :attribute е задължително, когато :other е прието.',
    'required_unless' => 'Полето :attribute е задължително, освен ако :other не е сред :values.',
    'required_with' => 'Полето :attribute е задължително, когато :values са налични.',
    'required_with_all' => 'Полето :attribute е задължително, когато всички :values са налични.',
    'required_without' => 'Полето :attribute е задължително, когато :values не са налични.',
    'required_without_all' => 'Полето :attribute е задължително, когато нито едно от :values не е налично.',
    'same' => ':attribute и :other трябва да съвпадат.',
    'size' => [
        'array' => ':attribute трябва да съдържа :size елемента.',
        'file' => ':attribute трябва да бъде :size килобайта.',
        'numeric' => ':attribute трябва да бъде :size.',
        'string' => ':attribute трябва да бъде :size знака.',
    ],
    'starts_with' => ':attribute трябва да започва с едно от следните: :values.',
    'string' => ':attribute трябва да бъде низ.',
    'timezone' => ':attribute трябва да бъде валиден часови пояс.',
    'unique' => ':attribute вече е зает/о.',
    'uploaded' => ':attribute не успя да качи.',
    'uppercase' => ':attribute трябва да бъде написано с главни букви.',
    'url' => ':attribute трябва да бъде валиден URL.',
    'ulid' => ':attribute трябва да бъде валиден ULID.',
    'uuid' => ':attribute трябва да бъде валиден UUID.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
