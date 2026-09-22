<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute ველი უნდა იყოს მიღებული.',
    'accepted_if' => ':attribute ველი უნდა იყოს მიღებული, როდესაც :other არის :value.',
    'active_url' => ':attribute ველი უნდა იყოს ვალიდური URL.',
    'after' => ':attribute ველი უნდა იყოს თარიღი, რომელიც მოდის :date-ის შემდეგ.',
    'after_or_equal' => ':attribute ველი უნდა იყოს თარიღი, რომელიც მოდის :date-ის შემდეგ ან მისი ტოლი.',
    'alpha' => ':attribute ველი უნდა შეიცავდეს მხოლოდ ასოებს.',
    'alpha_dash' => ':attribute ველი უნდა შეიცავდეს მხოლოდ ასოებს, ციფრებს, დეფისებს და ხაზგასმებს.',
    'alpha_num' => ':attribute ველი უნდა შეიცავდეს მხოლოდ ასოებსა და ციფრებს.',
    'any_of' => ':attribute ველი არასწორია.',
    'array' => ':attribute ველი უნდა იყოს მასივი.',
    'ascii' => ':attribute ველი უნდა შეიცავდეს მხოლოდ ერთბაიტიან ალფანუმერულ სიმბოლოებსა და ნიშნებს.',
    'before' => ':attribute ველი უნდა იყოს თარიღი, რომელიც მოდის :date-ის წინ.',
    'before_or_equal' => ':attribute ველი უნდა იყოს თარიღი, რომელიც მოდის :date-ის წინ ან მისი ტოლი.',
    'between' => [
        'array' => ':attribute ველი უნდა შეიცავდეს :min-დან :max-მდე ელემენტს.',
        'file' => ':attribute ველი უნდა იყოს :min-დან :max-მდე კილობაიტს შორის.',
        'numeric' => ':attribute ველი უნდა იყოს :min-სა და :max-ს შორის.',
        'string' => ':attribute ველი უნდა შეიცავდეს :min-დან :max-მდე სიმბოლოს.',
    ],
    'boolean' => ':attribute ველი უნდა იყოს true ან false.',
    'can' => ':attribute ველი შეიცავს დაუშვებელ მნიშვნელობას.',
    'confirmed' => ':attribute ველის დადასტურება არ ემთხვევა.',
    'contains' => ':attribute ველს აკლია სავალდებულო მნიშვნელობა.',
    'current_password' => 'პაროლი არასწორია.',
    'date' => ':attribute ველი უნდა იყოს ვალიდური თარიღი.',
    'date_equals' => ':attribute ველი უნდა იყოს თარიღი, რომელიც ემთხვევა :date-ს.',
    'date_format' => ':attribute ველი უნდა შეესაბამებოდეს ფორმატს :format.',
    'decimal' => ':attribute ველს უნდა ჰქონდეს :decimal ათწილადი ნიშანი.',
    'declined' => ':attribute ველი უნდა იყოს უარყოფილი.',
    'declined_if' => ':attribute ველი უნდა იყოს უარყოფილი, როდესაც :other არის :value.',
    'different' => ':attribute და :other ველები უნდა განსხვავდებოდეს.',
    'digits' => ':attribute ველი უნდა შედგებოდეს :digits ციფრისგან.',
    'digits_between' => ':attribute ველი უნდა შედგებოდეს :min-დან :max-მდე ციფრისგან.',
    'dimensions' => ':attribute ველს აქვს გამოსახულების არასწორი ზომები.',
    'distinct' => ':attribute ველს აქვს დუბლირებული მნიშვნელობა.',
    'doesnt_contain' => ':attribute ველი არ უნდა შეიცავდეს შემდეგთაგან არცერთს: :values.',
    'doesnt_end_with' => ':attribute ველი არ უნდა მთავრდებოდეს შემდეგთაგან არცერთით: :values.',
    'doesnt_start_with' => ':attribute ველი არ უნდა იწყებოდეს შემდეგთაგან არცერთით: :values.',
    'email' => ':attribute ველი უნდა იყოს ვალიდური ელფოსტის მისამართი.',
    'encoding' => ':attribute ველი უნდა იყოს კოდირებული :encoding-ში.',
    'ends_with' => ':attribute ველი უნდა მთავრდებოდეს შემდეგთაგან ერთ-ერთით: :values.',
    'enum' => 'არჩეული :attribute არასწორია.',
    'exists' => 'არჩეული :attribute არასწორია.',
    'extensions' => ':attribute ველს უნდა ჰქონდეს ერთ-ერთი შემდეგი გაფართოება: :values.',
    'file' => ':attribute ველი უნდა იყოს ფაილი.',
    'filled' => ':attribute ველს უნდა ჰქონდეს მნიშვნელობა.',
    'gt' => [
        'array' => ':attribute ველი უნდა შეიცავდეს :value-ზე მეტ ელემენტს.',
        'file' => ':attribute ველი უნდა იყოს :value კილობაიტზე მეტი.',
        'numeric' => ':attribute ველი უნდა იყოს :value-ზე მეტი.',
        'string' => ':attribute ველი უნდა იყოს :value სიმბოლოზე მეტი.',
    ],
    'gte' => [
        'array' => ':attribute ველი უნდა შეიცავდეს :value ან მეტ ელემენტს.',
        'file' => ':attribute ველი უნდა იყოს :value კილობაიტის ტოლი ან მეტი.',
        'numeric' => ':attribute ველი უნდა იყოს :value-ის ტოლი ან მეტი.',
        'string' => ':attribute ველი უნდა იყოს :value სიმბოლოს ტოლი ან მეტი.',
    ],
    'hex_color' => ':attribute ველი უნდა იყოს ვალიდური თექვსმეტობითი ფერი.',
    'image' => ':attribute ველი უნდა იყოს გამოსახულება.',
    'in' => 'არჩეული :attribute არასწორია.',
    'in_array' => ':attribute ველი უნდა არსებობდეს :other-ში.',
    'in_array_keys' => ':attribute ველი უნდა შეიცავდეს მინიმუმ ერთ-ერთ შემდეგი გასაღებთაგან: :values.',
    'integer' => ':attribute ველი უნდა იყოს მთელი რიცხვი.',
    'ip' => ':attribute ველი უნდა იყოს ვალიდური IP მისამართი.',
    'ipv4' => ':attribute ველი უნდა იყოს ვალიდური IPv4 მისამართი.',
    'ipv6' => ':attribute ველი უნდა იყოს ვალიდური IPv6 მისამართი.',
    'json' => ':attribute ველი უნდა იყოს ვალიდური JSON სტრიქონი.',
    'list' => ':attribute ველი უნდა იყოს სია.',
    'lowercase' => ':attribute ველი უნდა იყოს პატარა ასოებით.',
    'lt' => [
        'array' => ':attribute ველი უნდა შეიცავდეს :value-ზე ნაკლებ ელემენტს.',
        'file' => ':attribute ველი უნდა იყოს :value კილობაიტზე ნაკლები.',
        'numeric' => ':attribute ველი უნდა იყოს :value-ზე ნაკლები.',
        'string' => ':attribute ველი უნდა იყოს :value სიმბოლოზე ნაკლები.',
    ],
    'lte' => [
        'array' => ':attribute ველი არ უნდა შეიცავდეს :value-ზე მეტ ელემენტს.',
        'file' => ':attribute ველი უნდა იყოს :value კილობაიტის ტოლი ან ნაკლები.',
        'numeric' => ':attribute ველი უნდა იყოს :value-ის ტოლი ან ნაკლები.',
        'string' => ':attribute ველი უნდა იყოს :value სიმბოლოს ტოლი ან ნაკლები.',
    ],
    'mac_address' => ':attribute ველი უნდა იყოს ვალიდური MAC მისამართი.',
    'max' => [
        'array' => ':attribute ველი არ უნდა შეიცავდეს :max-ზე მეტ ელემენტს.',
        'file' => ':attribute ველი არ უნდა აღემატებოდეს :max კილობაიტს.',
        'numeric' => ':attribute ველი არ უნდა აღემატებოდეს :max-ს.',
        'string' => ':attribute ველი არ უნდა აღემატებოდეს :max სიმბოლოს.',
    ],
    'max_digits' => ':attribute ველი არ უნდა შეიცავდეს :max ციფრზე მეტს.',
    'mimes' => ':attribute ველი უნდა იყოს შემდეგი ტიპის ფაილი: :values.',
    'mimetypes' => ':attribute ველი უნდა იყოს შემდეგი ტიპის ფაილი: :values.',
    'min' => [
        'array' => ':attribute ველი უნდა შეიცავდეს მინიმუმ :min ელემენტს.',
        'file' => ':attribute ველი უნდა იყოს მინიმუმ :min კილობაიტი.',
        'numeric' => ':attribute ველი უნდა იყოს მინიმუმ :min.',
        'string' => ':attribute ველი უნდა შეიცავდეს მინიმუმ :min სიმბოლოს.',
    ],
    'min_digits' => ':attribute ველი უნდა შეიცავდეს მინიმუმ :min ციფრს.',
    'missing' => ':attribute ველი არ უნდა არსებობდეს.',
    'missing_if' => ':attribute ველი არ უნდა არსებობდეს, როდესაც :other არის :value.',
    'missing_unless' => ':attribute ველი არ უნდა არსებობდეს, გარდა იმ შემთხვევისა, როცა :other არის :value.',
    'missing_with' => ':attribute ველი არ უნდა არსებობდეს, როდესაც :values წარმოდგენილია.',
    'missing_with_all' => ':attribute ველი არ უნდა არსებობდეს, როდესაც :values წარმოდგენილია.',
    'multiple_of' => ':attribute ველი უნდა იყოს :value-ის ჯერადი.',
    'not_in' => 'არჩეული :attribute არასწორია.',
    'not_regex' => ':attribute ველის ფორმატი არასწორია.',
    'numeric' => ':attribute ველი უნდა იყოს რიცხვი.',
    'password' => [
        'letters' => ':attribute ველი უნდა შეიცავდეს მინიმუმ ერთ ასოს.',
        'mixed' => ':attribute ველი უნდა შეიცავდეს მინიმუმ ერთ დიდ და ერთ პატარა ასოს.',
        'numbers' => ':attribute ველი უნდა შეიცავდეს მინიმუმ ერთ ციფრს.',
        'symbols' => ':attribute ველი უნდა შეიცავდეს მინიმუმ ერთ სიმბოლოს.',
        'uncompromised' => 'მოცემული :attribute აღმოჩენილია მონაცემთა გაჟონვაში. გთხოვთ, აირჩიოთ სხვა :attribute.',
    ],
    'present' => ':attribute ველი უნდა იყოს წარმოდგენილი.',
    'present_if' => ':attribute ველი უნდა იყოს წარმოდგენილი, როდესაც :other არის :value.',
    'present_unless' => ':attribute ველი უნდა იყოს წარმოდგენილი, გარდა იმ შემთხვევისა, როცა :other არის :value.',
    'present_with' => ':attribute ველი უნდა იყოს წარმოდგენილი, როდესაც :values წარმოდგენილია.',
    'present_with_all' => ':attribute ველი უნდა იყოს წარმოდგენილი, როდესაც :values წარმოდგენილია.',
    'prohibited' => ':attribute ველი დაუშვებელია.',
    'prohibited_if' => ':attribute ველი დაუშვებელია, როდესაც :other არის :value.',
    'prohibited_if_accepted' => ':attribute ველი დაუშვებელია, როდესაც :other მიღებულია.',
    'prohibited_if_declined' => ':attribute ველი დაუშვებელია, როდესაც :other უარყოფილია.',
    'prohibited_unless' => ':attribute ველი დაუშვებელია, გარდა იმ შემთხვევისა, როცა :other არის :values-ში.',
    'prohibits' => ':attribute ველი კრძალავს :other-ის არსებობას.',
    'regex' => ':attribute ველის ფორმატი არასწორია.',
    'required' => ':attribute ველი სავალდებულოა.',
    'required_array_keys' => ':attribute ველი უნდა შეიცავდეს ჩანაწერებს: :values.',
    'required_if' => ':attribute ველი სავალდებულოა, როდესაც :other არის :value.',
    'required_if_accepted' => ':attribute ველი სავალდებულოა, როდესაც :other მიღებულია.',
    'required_if_declined' => ':attribute ველი სავალდებულოა, როდესაც :other უარყოფილია.',
    'required_unless' => ':attribute ველი სავალდებულოა, გარდა იმ შემთხვევისა, როცა :other არის :values-ში.',
    'required_with' => ':attribute ველი სავალდებულოა, როდესაც :values წარმოდგენილია.',
    'required_with_all' => ':attribute ველი სავალდებულოა, როდესაც :values წარმოდგენილია.',
    'required_without' => ':attribute ველი სავალდებულოა, როდესაც :values არ არის წარმოდგენილი.',
    'required_without_all' => ':attribute ველი სავალდებულოა, როდესაც :values-დან არცერთი არ არის წარმოდგენილი.',
    'same' => ':attribute ველი უნდა ემთხვეოდეს :other-ს.',
    'size' => [
        'array' => ':attribute ველი უნდა შეიცავდეს :size ელემენტს.',
        'file' => ':attribute ველი უნდა იყოს :size კილობაიტი.',
        'numeric' => ':attribute ველი უნდა იყოს :size.',
        'string' => ':attribute ველი უნდა შეიცავდეს :size სიმბოლოს.',
    ],
    'starts_with' => ':attribute ველი უნდა იწყებოდეს შემდეგთაგან ერთ-ერთით: :values.',
    'string' => ':attribute ველი უნდა იყოს სტრიქონი.',
    'timezone' => ':attribute ველი უნდა იყოს ვალიდური დროის სარტყელი.',
    'unique' => ':attribute უკვე დაკავებულია.',
    'uploaded' => ':attribute-ის ატვირთვა ვერ მოხერხდა.',
    'uppercase' => ':attribute ველი უნდა იყოს დიდი ასოებით.',
    'url' => ':attribute ველი უნდა იყოს ვალიდური URL.',
    'ulid' => ':attribute ველი უნდა იყოს ვალიდური ULID.',
    'uuid' => ':attribute ველი უნდა იყოს ვალიდური UUID.',

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
