<?php
return [

    'sections' => [

        'personal_information' => [
            'weight' => 50,
            'fields' => [
                'first_name',
                'last_name',
                'gender',
                'nationality',
                'marital_status',
                'personal_email',
                'contact_number',
                'date_of_birth',
            ],
        ],

        'address_information' => [
            'weight' => 30,
            'fields' => [
                'building_number',
                'street_name',
                'district',
                'city',
                'postal_code',
            ],
        ],

        'id_information' => [
            'weight' => 20,
            'documents' => [
                'national_id',
            ],
        ],
    ],
];
