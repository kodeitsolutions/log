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

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El campo :attribute sólo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute sólo puede contener letras, números y guiones (a-z, 0-9, -_).',
    'alpha_num'            => 'El campo :attribute sólo puede contener letras y números.',
    'array'                => 'El campo :attribute debe ser un array.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El campo confirmación de :attribute no coincide.',
    'country'              => 'El campo :attribute no es un país válido.',
    'date'                 => 'El campo :attribute no corresponde con una fecha válida.',
    'date_format'          => 'El campo :attribute no corresponde con el formato de fecha :format.',
    'different'            => 'Los campos :attribute y :other han de ser diferentes.',
    'digits'               => 'El campo :attribute debe ser un número de :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe contener entre :min y :max dígitos.',
    'dimensions'           => 'El campo :attribute tiene dimensiones invalidas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El campo :attribute no corresponde con una dirección de e-mail válida.',
    'file'                 => 'El campo :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'exists'               => 'El campo :attribute no existe.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute debe ser igual a alguno de estos valores :values',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe ser una cadena de texto JSON válida.',
    'max'                  => [
        'numeric' => 'El campo :attribute debe ser :max como máximo.',
        'file'    => 'El archivo :attribute debe pesar :max kilobytes como máximo.',
        'string'  => 'El campo :attribute debe contener :max caracteres como máximo.',
        'array'   => 'El campo :attribute debe contener :max elementos como máximo.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo de tipo :values.',
    'mimetypes'            => 'El campo :attribute debe ser un archivo de tipo :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe tener al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe contener al menos :min caracteres.',
        'array'   => 'El campo :attribute no debe contener más de :min elementos.',
    ],
    'not_in'               => 'El campo :attribute seleccionado es invalido.',
    'numeric'              => 'El campo :attribute debe ser un numero.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato del campo :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio',
    'required_if'          => 'El campo :attribute es obligatorio cuando el campo :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other se encuentre en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ningún campo :values están presentes.',
    'same'                 => 'Los campos :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'El campo :attribute debe contener :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'state'                => 'El estado no es válido para el país seleccionado.',
    'string'               => 'El campo :attribute debe contener solo caracteres.',
    'timezone'             => 'El campo :attribute debe contener una zona válida.',
    'unique'               => 'El elemento :attribute ya está en uso.',
    'uploaded'             => 'El elemento :attribute fallo al subir.',
    'url'                  => 'El formato de :attribute no corresponde con el de una URL válida.',

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
        'description' => [
            'required' => 'Debe ingresar una descripción',
        ],
        'code' => [
            'max' => 'El código debe ser de :max caracteres.',
            'alpha_num' => 'El código debe contener solo letras y números.',
            'unique'   => 'Este código ya se encuentra registrado.',
        ],
        'search' => [
            'required' => 'Debe seleccionar un parámetro de búsqueda.'
        ],
        'value' => [
            'required' => 'Debe ingresar un dato para buscar.'
        ],
        'name' => [
            'unique'   => 'Este nombre ya se encuentra registrado.',
            'required' => 'El campo nombre es obligatorio.',
        ],
        'password' => [
            'confirmed' => 'La confirmación de la contraseña no coincide.',
            'min' => 'La contraseña debe tener mínimo :min caracteres.'
        ],
        'vehicle_plate' => [
            'alpha_num' => 'La placa del vehículo solo debe contener números y letras.'
        ],
        'email' => [
            'unique' => 'Este email ya se encuentra registrado.',
            'email' => 'Debe ingresar una dirección de correo electrónico válida.'
        ],
        'username' => [
            'unique' => 'Este usuario ya se encuentra registrado.',
            'email' => 'Debe ingresar una dirección de correo electrónico válida.'
        ],
        'minute' => [
            'required' => 'El campo minutos es obligatorio.',
        ],
        'hour' => [
            'required' => 'El campo hora es obligatorio.',
        ],
        'operation_id' => [
            'required' => 'El campo Tipo de Movimiento es obligatorio.',
        ],
        'categorie_id' => [
            'required' => 'El campo Categoría es obligatorio.',
        ],
        'companie_id' => [
            'required' => 'El campo Empresa es obligatorio.',
        ],
        'person_name' => [
            'required_if' => 'El campo Nombre es obligatorio cuando la categoría incluye PERSONA.',
        ],
        'person_id' => [
            'required_if' => 'El campo Cédula es obligatorio cuando la categoría incluye PERSONA.',
        ],
        'person_occupation' => [
            'required_if' => 'El campo Ocupación es obligatorio cuando la categoría incluye PERSONA.',
        ],
        'person_company' => [
            'required_if' => 'El campo Empresa es obligatorio cuando la categoría incluye PERSONA.',
        ],
        'material_type' => [
            'required_if' => 'El campo Descripción es obligatorio cuando la categoría incluye MATERIAL.',
        ],
        'material_quantity' => [
            'required_if' => 'El campo Cantidad es obligatorio cuando la categoría incluye MATERIAL.',
        ],
        'unit_id' => [
            'required_if' => 'El campo Unidad es obligatorio cuando la categoría incluye MATERIAL.',
        ],
        'start' => [
            'different' => 'Los campos Comienzo y Fin deben ser diferentes.',
            'unique' => 'Hora de inicio de turno ya registrada.'
        ],
        'end' => [
            'unique' => 'Hora de fin de turno ya registrada.'
        ],
        'worker_id' => [
            'required' => 'El campo cédula es obligatorio.',
            'unique' => 'Esta cédula ya se encuentra registrada.'
        ],
        'position' => [
            'required' => 'El campo cargo es obligatorio.',
        ],
        'department' => [
            'required' => 'El campo departamento es obligatorio.',
        ],
        'recipient' => [
            'required' => 'El campo destinatario es obligatorio.',
        ],
         'moment' => [
            'required' => 'El campo momento es obligatorio.',
        ],   
        'category' => [
            'required' => 'El campo categoría es obligatorio.',
        ],
        'company' => [
            'required' => 'El campo empresa es obligatorio.',
        ],    
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
