<?php

return [
 'accepted'         => 'Поле :attribute должно быть принято.',
    'active_url'       => 'Поле :attribute не является действительным URL.',
    'after'            => 'Поле :attribute должно быть датой после :date.',
    'after_or_equal'   => 'Поле :attribute должно быть датой после или равной :date.',
    'alpha'            => 'Поле :attribute может содержать только буквы.',
    'alpha_dash'       => 'Поле :attribute может содержать только буквы, цифры и тире.',
    'alpha_num'        => 'Поле :attribute может содержать только буквы и цифры.',
    'latin'            => 'Поле :attribute может содержать только буквы латинского алфавита.',
    'latin_dash_space' => 'Поле :attribute может содержать только буквы латинского алфавита, цифры, тире и пробелы.',
    'array'            => 'Поле :attribute должно быть массивом.',
    'before'           => 'Поле :attribute должно быть датой до :date.',
    'before_or_equal'  => 'Поле :attribute должно быть датой до или равной :date.',
    'between'          => [
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'file'    => 'Поле :attribute должно быть между :min и :max килобайт.',
        'string'  => 'Поле :attribute должно быть между :min и :max символов.',
        'array'   => 'Поле :attribute должно содержать от :min до :max элементов.',
    ],
    'boolean'          => 'Поле :attribute должно быть истиной или ложью.',
    'confirmed'        => 'Подтверждение :attribute не совпадает.',
    'current_password' => 'Неверный пароль.',
    'date'             => 'Поле :attribute не является действительной датой.',
    'date_equals'      => 'Поле :attribute должно быть датой, равной :date.',
    'date_format'      => 'Поле :attribute не соответствует формату :format.',
    'different'        => 'Поле :attribute и :other должны отличаться.',
    'digits'           => 'Поле :attribute должно состоять из :digits цифр.',
    'digits_between'   => 'Поле :attribute должно содержать от :min до :max цифр.',
    'dimensions'       => 'Поле :attribute имеет неверные размеры изображения.',
    'distinct'         => 'Поле :attribute содержит дублирующее значение.',
    'email'            => 'Поле :attribute должно быть действительным адресом электронной почты.',
    'ends_with'        => 'Поле :attribute должно заканчиваться одним из следующих: :values.',
    'exists'           => 'Выбранное значение :attribute недействительно.',
    'file'             => 'Поле :attribute должно быть файлом.',
    'filled'           => 'Поле :attribute должно иметь значение.',
    'gt'               => [
        'numeric' => 'Поле :attribute должно быть больше, чем :value.',
        'file'    => 'Поле :attribute должно быть больше, чем :value килобайт.',
        'string'  => 'Поле :attribute должно быть длиннее, чем :value символов.',
        'array'   => 'Поле :attribute должно содержать больше, чем :value элементов.',
    ],
    'gte' => [
        'numeric' => 'Поле :attribute должно быть больше или равно :value.',
        'file'    => 'Поле :attribute должно быть больше или равно :value килобайт.',
        'string'  => 'Поле :attribute должно быть больше или равно :value символов.',
        'array'   => 'Поле :attribute должно содержать :value элементов или больше.',
    ],
    'image'    => 'Поле :attribute должно быть изображением.',
    'in'       => 'Выбранное значение :attribute недействительно.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer'  => 'Поле :attribute должно быть целым числом.',
    'ip'       => 'Поле :attribute должно быть действительным IP-адресом.',
    'ipv4'     => 'Поле :attribute должно быть действительным IPv4-адресом.',
    'ipv6'     => 'Поле :attribute должно быть действительным IPv6-адресом.',
    'json'     => 'Поле :attribute должно быть действительной строкой JSON.',
    'lt'       => [
        'numeric' => 'Поле :attribute должно быть меньше, чем :value.',
        'file'    => 'Поле :attribute должно быть меньше, чем :value килобайт.',
        'string'  => 'Поле :attribute должно быть короче, чем :value символов.',
        'array'   => 'Поле :attribute должно содержать меньше, чем :value элементов.',
    ],
    'lte' => [
        'numeric' => 'Поле :attribute должно быть меньше или равно :value.',
        'file'    => 'Поле :attribute должно быть меньше или равно :value килобайт.',
        'string'  => 'Поле :attribute должно быть меньше или равно :value символов.',
        'array'   => 'Поле :attribute не должно содержать больше :value элементов.',
    ],
    'max' => [
        'numeric' => 'Поле :attribute не может быть больше :max.',
        'file'    => 'Поле :attribute не может быть больше :max килобайт.',
        'string'  => 'Поле :attribute не может содержать больше :max символов.',
        'array'   => 'Поле :attribute не может содержать более :max элементов.',
    ],
    'mimes'     => 'Поле :attribute должно быть файлом одного из типов: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом одного из типов: :values.',
    'min'       => [
        'numeric' => 'Поле :attribute должно быть не менее :min.',
        'file'    => 'Поле :attribute должно быть не менее :min килобайт.',
        'string'  => 'Поле :attribute должно содержать не менее :min символов.',
        'array'   => 'Поле :attribute должно содержать не менее :min элементов.',
    ],
    'not_in'               => 'Выбранное значение :attribute недействительно.',
    'not_regex'            => 'Формат :attribute недействителен.',
    'numeric'              => 'Поле :attribute должно быть числом.',
    'password'             => 'Пароль неверен.',
    'present'              => 'Поле :attribute должно быть присутствующим.',
    'regex'                => 'Формат :attribute недействителен.',
    'required'             => 'Поле :attribute обязательно для заполнения.',
    'required_if'          => 'Поле :attribute обязательно, когда :other равно :value.',
    'required_unless'      => 'Поле :attribute обязательно, если :other не находится в :values.',
    'required_with'        => 'Поле :attribute обязательно, когда :values присутствует.',
    'required_with_all'    => 'Поле :attribute обязательно, когда :values присутствует.',
    'required_without'     => 'Поле :attribute обязательно, когда :values отсутствует.',
    'required_without_all' => 'Поле :attribute обязательно, когда ни одно из :values отсутствует.',
    'same'                 => 'Поле :attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => 'Поле :attribute должно быть :size.',
        'file'    => 'Поле :attribute должно быть :size килобайт.',
        'string'  => 'Поле :attribute должно содержать :size символов.',
        'array'   => 'Поле :attribute должно содержать :size элементов.',
    ],
    'starts_with' => 'Поле :attribute должно начинаться с одного из следующих: :values.',
    'string'      => 'Поле :attribute должно быть строкой.',
    'timezone'    => 'Поле :attribute должно быть действительной зоной.',
    'unique'      => 'Поле :attribute уже занято.',
    'uploaded'    => 'Поле :attribute не удалось загрузить.',
    'url'         => 'Формат :attribute недействителен.',
    'uuid'        => 'Поле :attribute должно быть действительным UUID.',
    'custom'      => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'reserved_word'                  => 'Поле :attribute содержит зарезервированное слово.',
    'dont_allow_first_letter_number' => 'Поле ":input" не может начинаться с цифры.',
    'exceeds_maximum_number'         => 'Поле :attribute превышает максимальную длину.',
    'db_column'                      => 'Поле :attribute может содержать только буквы латинского алфавита, цифры, тире и не может начинаться с цифры.',
    'attributes'                     => [],

];