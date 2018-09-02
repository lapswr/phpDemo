<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TotalsTest extends TestCase
{
	/**
     * Test a simple example of different products and get Total
     *
     * @return void
     */
    public function testSimpleTotals()
    {
    	$headers = [
    		"Accept" => "application/json",
    		"Content-Type" => "application/json"
    	];

        $data = [
            "products" => [
			    [
			      "product_id" => 1,
			      "qty" => 1
			    ],
			    [
			      "product_id" => 2,
			      "qty" => 1
			    ],
			    [
			      "product_id" => 3,
			      "qty" => 1
			    ]
			]
        ];

        $this->json('POST', '/api/totals', $data, $headers)
            ->assertStatus(200)
            ->assertJson([
                "total" => 6.5
            ]);
    }

    /**
     * Test simple meal deal and get total
     *
     * @return void
     */
    public function testSimpleMealDeal()
    {
    	$headers = [
    		"Accept" => "application/json",
    		"Content-Type" => "application/json"
    	];

        $data = [
            "products" => [
			    [
			      "product_id" => 2,
			      "qty" => 1
			    ],
			    [
			      "product_id" => 3,
			      "qty" => 1
			    ],
			    [
			      "product_id" => 4,
			      "qty" => 1
			    ]
			]
        ];

        $this->json('POST', '/api/totals', $data, $headers)
            ->assertStatus(200)
            ->assertJson([
                "total" => 3
            ]);
    }

    /**
     * Test a more complicate meal deal and get total
     *
     * @return void
     */
    public function testComplicateMealDeal()
    {
    	$headers = [
    		"Accept" => "application/json",
    		"Content-Type" => "application/json"
    	];

        $data = [
            "products" => [
			    [
			      "product_id" => 1,
			      "qty" => 1
			    ],
			    [
			      "product_id" => 2,
			      "qty" => 2
			    ],
			    [
			      "product_id" => 3,
			      "qty" => 2
			    ],
			    [
			      "product_id" => 4,
			      "qty" => 2
			    ],
			    [
			      "product_id" => 7,
			      "qty" => 1
			    ]
			]
        ];

        $this->json('POST', '/api/totals', $data, $headers)
            ->assertStatus(200)
            ->assertJson([
                "total" => 10.25
            ]);
    }

    /**
     * Test to input a wrong product id in the first product
     *
     * @return void
     */
    public function testWrongProductId()
    {
    	$headers = [
    		"Accept" => "application/json",
    		"Content-Type" => "application/json"
    	];

        $data = [
            "products" => [
			    [
			      "product_id" => 11,
			      "qty" => 1
			    ],
			    [
			      "product_id" => 2,
			      "qty" => 1
			    ],
			    [
			      "product_id" => 3,
			      "qty" => 1
			    ]
			]
        ];

        $this->json('POST', '/api/totals', $data, $headers)
            ->assertStatus(422)
            ->assertJson([
				"message"=> "The given data was invalid.",
				"errors"=> [
					"products.0.product_id" => [
						"The selected products.0.product_id is invalid."
					]
				]
			]);
    }
}