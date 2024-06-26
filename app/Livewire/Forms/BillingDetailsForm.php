<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BillingDetailsForm extends Form
{
	#[Validate('required|min:3')]
	public $first_name;
	#[Validate('required|min:3')]
	public $last_name;
	#[Validate('required|min:3')]
	public $address_line_1;
	#[Validate('nullable|min:3')]
	public $address_line_2;
	#[Validate('required|min:3')]
	public $city;
	#[Validate('required|min:3')]
	public $state;
	#[Validate('required|min:3')]
	public $postal_code;
	#[Validate('required|email')]
	public $email;

	public $same_as_billing = true;

	// Shipping
	#[Validate('required|min:3')]
	public $shipping_first_name;
	#[Validate('required|min:3')]
	public $shipping_last_name;
	#[Validate('required|min:3')]
	public $shipping_address_line_1;
	#[Validate('nullable|min:3')]
	public $shipping_address_line_2;
	#[Validate('required|min:3')]
	public $shipping_city;
	#[Validate('required|min:3')]
	public $shipping_state;
	#[Validate('required|min:3')]
	public $shipping_postal_code;
	#[Validate('required|email')]
	public $shipping_email;

	#[Validate('required')]
	public $payment_method = 'cash';
}
