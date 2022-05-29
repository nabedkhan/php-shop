<?php
require_once "stripe-php/init.php";
require_once "config/index.php";

class PaymentController {
    private $stripeKey = STRIPE_KEY;
    private $stripe = null;

    public function __construct() {
        $this->stripe = new \Stripe\StripeClient($this->stripeKey);
    }

    /**
     * create charge from stripe account
     * @param  mixed $chargeInfo
     * @return array
     */
    public function createChargeFromCard(array $chargeInfo) {
        $token = $this->stripe->tokens->create([
            'card' => [
                'number'    => $chargeInfo['cardNo'],
                'exp_month' => $chargeInfo['cardExpMonth'],
                'exp_year'  => $chargeInfo['cardExpYear'],
                'cvc'       => $chargeInfo['cardCvc'],
            ],
        ]);

        $charge = $this->stripe->charges->create([
            'currency' => 'usd',
            'source'   => $token->id,
            'amount'   => $chargeInfo['amount'] * 100,
        ]);

        $chargeId = $charge->id;
        $paymentStatus = $charge->status;
        $chargeAmount = $charge->amount / 100;
        $cardType = $charge->payment_method_details->card->brand;

        return [
            'chargeId'      => $chargeId,
            'chargeAmount'  => $chargeAmount,
            'cardType'      => $cardType,
            'paymentStatus' => $paymentStatus,
        ];
    }
}