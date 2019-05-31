<?php
return [
    "tables"=>[
        "staff" => [
            "name" => [
                "type" => "normal"
            ],
            "id" => [
                "type" => "hasmany",
                "column" => "staff_id",
                "table" => "invoices",
            ]
        ],
        "product" => [
            "name" => [
                "type" => "normal",
                "length" => 20,
                "nullable" => true,
                "unique" => true,
                "default" => "this is name",
            ],
            "price" => [
                "type" => "normal",
                "length" => 10,
                "scale" => 2,
            ],
            "id" => [
                "type" => "hasmany",
                "column" => "product_id",
                "table" => "invoice_details",
            ]
        ],
        "invoices" => [
            "date" => [
                "type" => "normal"
            ],
            "total" => [
                "type" => "normal"
            ],
            "staff_id" => [
                "type" => "belongsto",
                "column" => "staff_id",
                "table" => "staff"
            ],
            "id" => [
                "type" => "hasmany",
                "column" => "invoice_id",
                "table" => "invoice_details"
            ]
        ],
        "invoice_details" => [
            "qty" => [
                "type" => "normal"
            ],
            "amount" => [
                "type" => "normal"
            ],
            "product_id" => [
                "type" => "belongsto",
                "column" => "product_id",
                "table" => "product"
            ],
            "invoice_id" => [
                "type" => "belongsto",
                "column" => "invoice_id",
                "table" => "invoices"
            ]
        ]
    ]
];

