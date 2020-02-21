<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\LoblawsellerApi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class LoblawsellerTest extends TestCase {

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAuthentication() {
        $api = new LoblawsellerApi;
        $response = $this->call('POST', 'https://private-anon-bee1840de5-loblawsellerportal.apiary-mock.com/v1/auth/token', [
            'headers' => [
                'Authorization' => 'Basic Y2xpZW50X2lkOmNsaWVudF9zZWNyZXQ='
            ]
        ]);
        if (!empty($response)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(FALSE);
        }
    }

    public function testGetProduct() {
        $api = new LoblawsellerApi;
        //$response = $api->getProduct();
        $response = $this->call('GET', 'https://private-anon-bee1840de5-loblawsellerportal.apiary-mock.com/v1/product',[
                'headers' => [
                    'Authorization' => 'Basic Y2xpZW50X2lkOmNsaWVudF9zZWNyZXQ='
                ]
        ]);
        if (!empty($response)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(FALSE);
        }
    }

    public function testCreateProduct() {
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
        $response = $this->call('POST', 'https://private-anon-bee1840de5-loblawsellerportal.apiary-mock.com/v1/product', [
            'body' => json_encode($data),
            'headers' => [
                'Authorization' => 'Basic Y2xpZW50X2lkOmNsaWVudF9zZWNyZXQ='
            ]
        ]);
        if (!empty($response)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(FALSE);
        }
    }

    public function testEditProduct() {
        $api = new LoblawsellerApi;
        $response = $api->editProduct();
        if (!empty($response)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(FALSE);
        }
    }

    public function testProductSearch() {
        $api = new LoblawsellerApi;
        $response = $api->productSearch();
        if (!empty($response)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(FALSE);
        }
    }

}
