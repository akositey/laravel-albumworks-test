<?php

namespace Tests\Unit;

use App\Order;
use App\Product;
use App\User;
use App\Services\RewardHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * set up
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rewardHelper = new RewardHelper();
    }

    /**
     * reward level manual test
     *
     * @return void
     */
    public function test_spent_amount_50_should_be_reward_level_0()
    {
        $this->assertEquals( $this->rewardHelper->getLevel(50), 0);
    }

    /**
     * reward level manual test
     *
     * @return void
     */
    public function test_spent_amount_100_should_be_reward_level_0()
    {
        $this->assertEquals( $this->rewardHelper->getLevel(100), 0);
    }

    /**
     * reward level manual test
     *
     * @return void
     */
    public function test_spent_amount_125_should_be_reward_level_1()
    {
        $this->assertEquals( $this->rewardHelper->getLevel(125), 1);
    }

    /**
     * reward level manual test
     *
     * @return void
     */
    public function test_spent_amount_999_should_be_reward_level_1()
    {
        $this->assertEquals( $this->rewardHelper->getLevel(999), 1);
    }
    /**
     * reward level manual test
     *
     * @return void
     */
    public function test_spent_amount_1000_should_be_reward_level_2()
    {
        $this->assertEquals( $this->rewardHelper->getLevel(1000), 2);
    }
    /**
     * reward level manual test
     *
     * @return void
     */
    public function test_spent_amount_1500_should_be_reward_level_2()
    {
        $this->assertEquals( $this->rewardHelper->getLevel(1500), 2);
    }

    /**
     * reward level manual test
     *
     * @return void
     */
    public function test_spent_amount_1999_should_be_reward_level_2()
    {
        $this->assertEquals( $this->rewardHelper->getLevel(1999), 2);
    }

    /**
     * reward level manual test
     *
     * @return void
     */
    public function test_spent_amount_2000_should_be_reward_level_3()
    {
        $this->assertEquals( $this->rewardHelper->getLevel(2000), 3);
    }

    /**
     * Test Reward Level Using Created Sample Data
     *
     * @return void
     */
    public function test_spent_amount_using_created_sample_data_should_match()
    {
        //create 1 user
        $user = factory(User::class, 1)->create();

        //create 10 products
        factory(Product::class, 10)->create();

        //simulate orders for 20 customers
        for ($i=0; $i <= 20; $i++) { 
            //random number of orders
            $ordersCount = $this->faker->numberBetween(1,20);

            $totalSpent = 0;
            $mostRecentPurchaseAmount = 0;
            for ($i=0; $i <= $ordersCount; $i++) { 
                $productId = $this->faker->numberBetween(1,10);
                $quantity = $this->faker->numberBetween(1,3);
                $productPrice = Product::find($productId)->price;

                // order info
                $amountPaid = floatval( number_format( $productPrice * $quantity, 2));
                $totalSpent += $amountPaid;
                $mostRecentPurchaseAmount = $i !== $ordersCount ? 0: $amountPaid;

                //create an order
                Order::create([
                    'user_id' => $user->first()->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'amount_paid' => $amountPaid,
                ]);
            }

            //total history
            $totalPreviousPurchaseAmount = $totalSpent-$mostRecentPurchaseAmount;
            //build customer data
            $customerPurchaseData = [
                'history' => $totalPreviousPurchaseAmount,
                'current' => $mostRecentPurchaseAmount,
            ];

            //get reward level
            $rewardLevel = $this->getRewardLevelFunctionCopy($totalSpent);

            //send request
            $response = $this->json('POST',route('user.reward-level'), $customerPurchaseData);
            if($response->status() !== 200){
                dd($response->getContent());
            }
            //assert status OK
            $response->assertStatus(200);

            //should be the same as using local function
            $response->assertExactJson([
                "level" => $rewardLevel
            ]);
        }
    }

    /**
     * A copy of RewardHelper@getLevel
     *
     * @param float $totalSpent
     * @return void
     */
    public function getRewardLevelFunctionCopy(float $totalSpent)
    {
        if ($totalSpent < 125 ) {
            return 0; // white
        }elseif ($totalSpent >= 125 && $totalSpent <= 999 ) {
            return 1; // blue
        }elseif ($totalSpent >= 1000 && $totalSpent <= 1999 ) {
            return 2; // silver
        }else{ //2000 & above
            return 3; // gold
        }
    }
}
