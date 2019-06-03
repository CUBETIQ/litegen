<?php
return [
    "data" => [
        "staff" => [
            "name" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::TEXT,
                "length" => 20,
                "nullable" => true,
                "unique" => false,
                "fillable" => true
            ],
            "invoices" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::HAS_MANY,
                "foreign" => "id",
                "column" => "staff_id",
                "table" => "invoices",
            ]
        ],
        "product" => [
            "name" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::TEXT,
                "length" => 20,
                "nullable" => true,
                "unique" => false,
                "fillable" => true
            ],
            "price" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::DECIMAL,
                "length" => 10,
                "scale" => 2,
                "nullable" => true,
                "unique" => false,
                "fillable" => true
            ],
            "detail" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::HAS_MANY,
                "foreign" => "id",
                "column" => "product_id",
                "table" => "invoice_details",
            ]
        ],
        "invoices" => [
            "date" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::DATETIME,
                "nullable" => true,
                "unique" => false,
                "fillable" => true
            ],
            "total" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::DECIMAL,
                "length" => 10,
                "scale" => 2,
                "nullable" => true,
                "unique" => false,
                "fillable" => true
            ],
            "staff" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::BELONGS_TO,
                "foreign" => "staff_id",
                "column" => "id",
                "table" => "staff",
                "fillable" => true
            ],
            "detail" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::HAS_MANY,
                "foreign" => "id",
                "column" => "invoice_id",
                "table" => "invoice_details"
            ],
            "product" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::BELONGSTOMANY,
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
        "invoice_details" => [
            "qty" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::INTEGER,
                "nullable" => true,
                "unique" => false,
                "fillable" => true
            ],
            "amount" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::DECIMAL,
                "length" => 10,
                "scale" => 2,
                "nullable" => true,
                "unique" => false,
                "fillable" => true
            ],
            "products" => [
                "type" => \Cubetiq\Litegen\Definitions\ModelType::BELONGS_TO,
                "foreign" => "product_id",
                "column" => "id",
                "table" => "products",
                "fillable" => true
            ],
            "invoices" => [
                "foreign" => "invoice_id",
                "type" => \Cubetiq\Litegen\Definitions\ModelType::BELONGS_TO,
                "column" => "id",
                "table" => "invoices",
                "fillable" => true
            ]
        ]
    ]
];

