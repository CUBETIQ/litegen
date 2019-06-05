<?php
return [
    "tables"=>[
        "staff" => [
            "columns" => [
                "name" => [
                    "type" => \Cubetiq\Litegen\Definitions\ModelType::TEXT,
                    "length" => 20,
                    "nullable" => false,
                    "unique" => false,
                ],
                "invoices" => [
                    "type" => \Cubetiq\Litegen\Definitions\RelationshipType::HAS_MANY,
                    "foreign" => "id",
                    "column" => "staff_id",
                    "table" => "invoices",
                ]
            ],
            'actions' => [
                "index" => true,
                "edit" => true,
                "delete" => true,
                "create" => true
            ],
        ],
        "product" => [
            "columns" => [
                "name" => [
                    "type" => \Cubetiq\Litegen\Definitions\ModelType::TEXT,
                    "length" => 20,
                    "nullable" => false,
                    "unique" => false,
                ],
                "price" => [
                    "type" => \Cubetiq\Litegen\Definitions\ModelType::DECIMAL,
                    "length" => 10,
                    "scale" => 2,
                    "nullable" => true,
                    "unique" => false,
                ],
                "detail" => [
                    "type" => \Cubetiq\Litegen\Definitions\RelationshipType::HAS_MANY,
                    "foreign" => "id",
                    "column" => "product_id",
                    "table" => "invoice_details",
                ]
            ],
            'actions' => [
                "index" => true,
                "edit" => true,
                "delete" => true,
                "create" => true
            ],
        ],
        "invoices" => [
            "columns" => [
                "date" => [
                    "type" => \Cubetiq\Litegen\Definitions\ModelType::DATETIME,
                    "nullable" => true,
                    "unique" => false,
                ],
                "total" => [
                    "type" => \Cubetiq\Litegen\Definitions\ModelType::DECIMAL,
                    "length" => 10,
                    "scale" => 2,
                    "nullable" => true,
                    "unique" => false,
                ],
                "staff" => [
                    "type" => \Cubetiq\Litegen\Definitions\RelationshipType::BELONGS_TO,
                    "foreign" => "staff_id",
                    "column" => "id",
                    "table" => "staff",
                ],
                "detail" => [
                    "type" => \Cubetiq\Litegen\Definitions\RelationshipType::HAS_MANY,
                    "foreign" => "id",
                    "column" => "invoice_id",
                    "table" => "invoice_details"
                ],
                "product" => [
                    "type" => \Cubetiq\Litegen\Definitions\RelationshipType::BELONGSTOMANY,
                    "through" => [
                        "table" => 'invoice_details',
                        "foreign_from" => "invoice_id",
                        "foreign_to" => "product_id"
                    ],
                    "table" => "products",
                    "column" => "id",
                    "foreign" => "id"
                ]
            ],
            'actions' => [
                "show" => true,
                "index" => true,
                "edit" => true,
                "delete" => true,
                "create" => true,

            ],
        ],
        "invoice_details" => [
            "columns" => [
                "qty" => [
                    "type" => \Cubetiq\Litegen\Definitions\ModelType::INTEGER,
                    "nullable" => true,
                    "unique" => false
                ],
                "amount" => [
                    "type" => \Cubetiq\Litegen\Definitions\ModelType::DECIMAL,
                    "length" => 10,
                    "scale" => 2,
                    "nullable" => true,
                    "unique" => false,
                ],
                "products" => [
                    "type" => \Cubetiq\Litegen\Definitions\RelationshipType::BELONGS_TO,
                    "foreign" => "product_id",
                    "column" => "id",
                    "table" => "products",
                    "fillable" => true
                ],
                "invoices" => [
                    "foreign" => "invoice_id",
                    "type" => \Cubetiq\Litegen\Definitions\RelationshipType::BELONGS_TO,
                    "column" => "id",
                    "table" => "invoices",
                    "fillable" => true
                ]
            ],
            'actions' => [
                "invoice_details" => [
                    "index" => true

                ],
            ]
        ]
    ],
    "non-tables"=>[
        [
            "name"=>"About"
        ],
        [
            "name"=>"Settings"
        ]
    ]
];
