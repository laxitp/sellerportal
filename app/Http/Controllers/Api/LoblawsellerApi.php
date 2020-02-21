<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Config;
use Redirect;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use Validator;

class LoblawsellerApi extends Controller {

    private $HTTP_status = 200;
    private $status = '';
    private $message = '';
    private $response = array();

    public function __construct() {

    }

    // METHOD - POST //
    public function authentication() {
        try {
            $base_url = "https://private-anon-bee1840de5-loblawsellerportal.apiary-mock.com/v1/auth/token";
            $client = new Client();
            $response = $client->post($base_url, [
                'headers' => [
                    'Authorization' => 'Basic Y2xpZW50X2lkOmNsaWVudF9zZWNyZXQ='
                ]
            ]);
            $this->response = json_decode($response->getBody(), true);
            $this->message = 'Authenticated successfully !';
            $this->status = 1;
        } catch (BadResponseException $e) {
            $this->response = '';
            $this->message = 'Not authenticated !';
            $this->status = 0;
        }
        return response()->json(['status' => $this->status, 'message' => $this->message, 'response' => $this->response], $this->HTTP_status);
    }

    // METHOD - GET //
    public function getProduct() {
        try {
            $base_url = "https://private-anon-bee1840de5-loblawsellerportal.apiary-mock.com/v1/product";
            $client = new Client();
            $response = $client->get($base_url, [
                'headers' => [
                    'Authorization' => 'Basic Y2xpZW50X2lkOmNsaWVudF9zZWNyZXQ='
                ]
            ]);
            $this->response = json_decode($response->getBody(), true);
            $this->message = 'Records found successfully !';
            $this->status = 1;
        } catch (BadResponseException $e) {
            $this->response = '';
            $this->message = 'Product not found !';
            $this->status = 0;
        }
        return response()->json(['status' => $this->status, 'message' => $this->message, 'response' => $this->response], $this->HTTP_status);
    }

    // METHOD - POST //
    public function createProduct() {
        $data = array(
            'id' => 123,
            'store_id' => 1,
            'title' => 'My Awesome Product',
            'title_fr' => 'Mon produit génial',
            'brand' => 'AwesomeCo',
            'condition' => 'New',
            'status' => 'Active',
            'quantity_available' => 10,
            'quantity_sold' => 5,
            'fixed_price' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'advertised_price' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'sale_price' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'sale_price_start_date' => '2018-06-09T11:23:45+00:00',
            'sale_price_end_date' => '2018-07-09T23:45:01+00:00',
            'map_price' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'dead_cost_price' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'shipping_cost' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'shipping_cost_expedited' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'shipping_cost_two_day' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'shipping_cost_one_day' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'handling_fee' =>
            array(
                'currency' => 'USD',
                'value' => 0,
            ),
            'shipping_dimensions_x' =>
            array(
                'unit' => 'mm',
                'length' => 0,
            ),
            'shipping_dimensions_y' =>
            array(
                'unit' => 'mm',
                'length' => 0,
            ),
            'shipping_dimensions_z' =>
            array(
                'unit' => 'mm',
                'length' => 0,
            ),
            'shipping_weight' =>
            array(
                'unit' => 'lbs',
                'weight' => 0,
            ),
            'description' => 'test demo',
            'description_fr' => 'test demo',
            'picture1' => 'http://example.com/images/picture1.jpg',
            'picture_1_angle' => 'Front',
            'picture2' => 'http://example.com/images/picture2.jpg',
            'picture_2_angle' => 'Front',
            'picture3' => '',
            'picture_3_angle' => 'Front',
            'picture4' => '',
            'picture_4_angle' => 'Front',
            'picture5' => '',
            'picture_5_angle' => 'Front',
            'picture6' => '',
            'picture_6_angle' => 'Front',
            'picture7' => '',
            'picture_7_angle' => 'Front',
            'picture8' => '',
            'picture_8_angle' => 'Front',
            'picture9' => '',
            'picture_9_angle' => 'Front',
            'picture10' => '',
            'picture_10_angle' => 'Front',
            'video1' => 'https://youtu.be/9bZkp7q19f0',
            'seller_website_url' => 'https://yourdomain.com/my-awesome-product',
            'manufacturer' => 'White-Labeler',
            'artist' => '',
            'description_short' => 'Lorem Ipsum',
            'description_short_fr' => 'Lorem Ipsum',
            'created_timestamp' => 'NULL',
            'upc' => '888462101103',
            'ean' => '5901234123457',
            'mpn' => 'MJLQ2LL/A',
            'sku' => 'MBP-15.4-2017-2.8-16-256',
            'isbn' => '',
            'merchant_id' => 'MID123',
            'item_group_id' => 'MBP-15.4-2017',
            'supplier_name' => 'Vendor1',
            'category_name_trail' => 'Computers & Electronics|Laptops|Apple',
            'merchant_category_name_trail' => '328 - Electronics > Computers > Laptops',
            'color' => 'Silver',
            'color_fr' => 'Argent',
            'color_details' => 'Chrome Silver',
            'color_details_fr' => 'Chrome Argent',
            'material' => 'Aluminum',
            'pattern' => '',
            'gender' => 'Female',
            'size' => 'Large',
            'size_system' => 'US',
            'size_units' => 'mm',
            'size_type' => 'Regular',
            'age_group' => 'Adult',
            'shape' => 'Circle',
            'texture' => 'Smooth',
            'firmness' => 'Firm',
            'capacity' => '16gb',
            'model' => '2017',
            'release_date' => '2017-05-01',
            'occasion' => 'Mothers Day',
            'country_of_origin' => 'US',
            'custom_attribs' =>
            array(
                0 =>
                array(
                    'name' => '',
                    'value' => '',
                ),
            ),
            'length' => '9in',
            'width' => '8in',
            'height' => '7in',
            'weight' => '6lbs',
            'multipack' => 0,
            'is_bundle' => false,
            'is_adult' => false,
            'identifier_exists' => true,
            'returns_policy_type' => 'NULL',
            'warranty_length' => 'NULL',
            'lead_time' => 1,
            'shipping_type' => 'datafeed',
            'ships_from_zip' => '89109',
            'dc_label' => 'DC123',
            'web_url' => 'http://example.com/product/my',
        );

        if (empty($data)) {
            $this->message = '';
            $this->status = 0;
        } else {
            try {
                $base_url = "https://private-anon-bee1840de5-loblawsellerportal.apiary-mock.com/v1/product";
                $client = new Client();
                $response = $client->post($base_url, [
                    'body' => json_encode($data),
                    'headers' => [
                        'Authorization' => 'Basic Y2xpZW50X2lkOmNsaWVudF9zZWNyZXQ='
                    ]
                ]);
                $this->response = json_decode($response->getBody(), true);
                $this->message = 'Product created successfully !';
                $this->status = 1;
            } catch (BadResponseException $e) {
                $this->response = '';
                $this->message = 'Not product created !';
                $this->status = 0;
            }
        }
        return response()->json(['status' => $this->status, 'message' => $this->message, 'response' => $this->response], $this->HTTP_status);
    }

    // METHOD - PUT  //
    public function editProduct() {
        $data = '{
        "id": 123,
        "store_id": 1,
        "title": "My Awesome Product",
        "title_fr": "Mon produit génial",
        "brand": "AwesomeCo",
        "condition": "New",
        "status": "Active",
        "quantity_available": 10,
        "quantity_sold": 5,
        "fixed_price": {
        "currency": "USD",
        "value": 0
        },
        "advertised_price": {
        "currency": "USD",
        "value": 0
        },
        "sale_price": {
        "currency": "USD",
        "value": 0
        },
        "sale_price_start_date": "2018-06-09T11:23:45+00:00",
        "sale_price_end_date": "2018-07-09T23:45:01+00:00",
        "map_price": {
        "currency": "USD",
        "value": 0
        },
        "dead_cost_price": {
        "currency": "USD",
        "value": 0
        },
        "shipping_cost": {
        "currency": "USD",
        "value": 0
        },
        "shipping_cost_expedited": {
        "currency": "USD",
        "value": 0
        },
        "shipping_cost_two_day": {
        "currency": "USD",
        "value": 0
        },
        "shipping_cost_one_day": {
        "currency": "USD",
        "value": 0
        },
        "handling_fee": {
        "currency": "USD",
        "value": 0
        },
        "shipping_dimensions_x": {
        "unit": "mm",
        "length": 0
        },
        "shipping_dimensions_y": {
        "unit": "mm",
        "length": 0
        },
        "shipping_dimensions_z": {
        "unit": "mm",
        "length": 0
        },
        "shipping_weight": {
        "unit": "lbs",
        "weight": 0
        },
        "description": "",
        "description_fr": "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.",
        "picture1": "http://example.com/images/picture1.jpg",
        "picture_1_angle": "Front",
        "picture2": "http://example.com/images/picture2.jpg",
        "picture_2_angle": "Front",
        "picture3": "",
        "picture_3_angle": "Front",
        "picture4": "",
        "picture_4_angle": "Front",
        "picture5": "",
        "picture_5_angle": "Front",
        "picture6": "",
        "picture_6_angle": "Front",
        "picture7": "",
        "picture_7_angle": "Front",
        "picture8": "",
        "picture_8_angle": "Front",
        "picture9": "",
        "picture_9_angle": "Front",
        "picture10": "",
        "picture_10_angle": "Front",
        "video1": "https://youtu.be/9bZkp7q19f0",
        "seller_website_url": "https://yourdomain.com/my-awesome-product",
        "manufacturer": "White-Labeler",
        "artist": "",
        "description_short": "Lorem Ipsum",
        "description_short_fr": "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.",
        "created_timestamp": "NULL",
        "upc": "888462101103",
        "ean": "5901234123457",
        "mpn": "MJLQ2LL/A",
        "sku": "MBP-15.4-2017-2.8-16-256",
        "isbn": "",
        "merchant_id": "MID123",
        "item_group_id": "MBP-15.4-2017",
        "supplier_name": "Vendor1",
        "category_name_trail": "Computers & Electronics|Laptops|Apple",
        "merchant_category_name_trail": "328 - Electronics > Computers > Laptops",
        "color": "Silver",
        "color_fr": "Argent",
        "color_details": "Chrome Silver",
        "color_details_fr": "Chrome Argent",
        "material": "Aluminum",
        "pattern": "",
        "gender": "Female",
        "size": "Large",
        "size_system": "US",
        "size_units": "mm",
        "size_type": "Regular",
        "age_group": "Adult",
        "shape": "Circle",
        "texture": "Smooth",
        "firmness": "Firm",
        "capacity": "16gb",
        "model": "2017",
        "release_date": "2017-05-01",
        "occasion": "Mothers Day",
        "country_of_origin": "US",
        "custom_attribs": [
        {
        "name": "",
        "value": ""
        }
        ],
        "length": "9in",
        "width": "8in",
        "height": "7in",
        "weight": "6lbs",
        "multipack": 0,
        "is_bundle": false,
        "is_adult": false,
        "identifier_exists": true,
        "returns_policy_type": "NULL",
        "warranty_length": "NULL",
        "lead_time": 1,
        "shipping_type": "datafeed",
        "ships_from_zip": "89109",
        "dc_label": "DC123",
        "web_url": "http://example.com/product/my"
        }';
        $myJSON = json_decode($data);
        if (!empty($myJSON)) {
            $this->message = '';
            $this->status = 0;
        } else {
            try {
                $base_url = "https://private-anon-bee1840de5-loblawsellerportal.apiary-mock.com/v1/product";
                $client = new Client();
                $response = $client->post($base_url, [
                    'body' => $myJSON,
                    'headers' => [
                        "Content-Type: application/json",
                        'Authorization' => 'Basic Y2xpZW50X2lkOmNsaWVudF9zZWNyZXQ='
                    ]
                ]);
                $this->response = json_decode($response->getBody(), true);
                $this->message = 'Product updated successfully !';
                $this->status = 1;
            } catch (BadResponseException $e) {
                $this->response = '';
                $this->message = 'Not product updated !';
                $this->status = 0;
            }
        }

        return response()->json(['status' => $this->status, 'message' => $this->message, 'response' => $this->response], $this->HTTP_status);
    }

    // METHOD - GET //
    public function productSearch() {
        $data = array(
            "title" => "My Awesome Product",
            "status" => "Active",
            "page" => 1,
            "limit" => 500
        );
        if (empty($data)) {
            $this->message = '';
            $this->status = 0;
        } else {
            try {
                $base_url = "https://private-anon-bee1840de5-loblawsellerportal.apiary-mock.com/v1/product/search";
                $client = new Client();
                $response = $client->get($base_url, [
                    'body' => json_encode($data),
                    'headers' => [
                        "Content-Type: application/json",
                        "Authentication: Bearer eyJhbGciOiJIUzI1NiJ9.e30.XmNK3GpH3Ys_7wsYBfq4C3M6goz71I7dTgUkuIa5lyQ"
                    ]
                ]);
                $this->response = json_decode($response->getBody(), true);
                $this->message = 'Search successfully !';
                $this->status = 1;
            } catch (BadResponseException $e) {
                $this->response = '';
                $this->message = 'Not Search !';
                $this->status = 0;
            }
        }
        return response()->json(['status' => $this->status, 'message' => $this->message, 'response' => $this->response], $this->HTTP_status);
    }

}
