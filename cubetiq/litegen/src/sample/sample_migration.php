<?php
use \Cubetiq\Litegen\Definitions\RelationshipType;
return [
    "tables" => [
        "columns" => [
            "staff" => [
                "name" => [
                    "type" => "varchar"
                ]
            ],
            "product" => [
                "name" => [
                    "type" => "varchar",
                    "length" => 20,
                    "nullable" => true,
                    "unique" => true,
                    "default" => "this is name",
                ],
                "price" => [
                    "type" => "decimal",
                    "length" => 10,
                    "scale" => 2,
                ]
            ],
            "invoices" => [
                "date" => [
                    "type" => "datetime"
                ],
                "total" => [
                    "type" => "decimal"
                ]
            ],
            "invoice_details" => [
                "qty" => [
                    "type" => "varchar"
                ],
                "amount" => [
                    "type" => "decimal"
                ]
            ]
        ],
        "relationships" => [
            "staff_invoices" => [
                "type" => RelationshipType::ONE_TO_MANY,
                "from" => [
                    "type" => "hasmany",
                    "table" => "staff",
                    "column" => "id",
                ],
                "to" => [
                    "type" => "belongsto",
                    "table" => "invoices",
                    "column" => "staff_id",
                ]
            ],
            "product_invoice_details" => [
                "type" => RelationshipType::ONE_TO_MANY,
                "from" => [
                    "type" => "hasmany",
                    "table" => "product",
                    "column" => "id"
                ],
                "to" => [
                    "type" => "belongsto",
                    "table" => "invoice_details",
                    "column" => "product_id",
                ],
            ],
            "invoices_invoice_details" => [
                "type" => RelationshipType::ONE_TO_MANY,
                "from" => [
                    "type" => "hasmany",
                    "table" => "invoices",
                    "column" => "id"
                ],
                "to" => [
                    "type" => "belongsto",
                    "table" => "invoice_details",
                    "column" => "invoice_id",
                ]
            ]
        ]
    ]
];
