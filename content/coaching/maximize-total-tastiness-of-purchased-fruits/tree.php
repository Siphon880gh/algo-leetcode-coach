<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: Each fruit has a price and a tastiness. You have a budget and a number of coupons. You may buy each fruit at most once, and you may use at most one coupon on a fruit to buy it for about half its price; the exact rounding is in the official statement. Return the largest total tastiness you can buy without going over the budget. For instance, prices [10,20,20], tastiness [5,8,8], budget 20 and 1 coupon → 13; with no coupons → 8. (Restated from memory; limits and examples may differ slightly.)\nChoose fruits how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over money spent and coupons used', 'next' => 's2'],
                ['label' => 'Greedy: most tasty first while it fits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. prices [20,10,10], tastiness [6,5,5], budget 20, no coupons → 6 instead of 10.\nStep back to when you picked greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop money and coupons in which direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From low to high', 'next' => 'wrong_b'],
                ['label' => 'From high to low', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A fruit can then be bought twice; price [10], tastiness [5], budget 20, no coupons → 10 instead of 5.\nStep back to when you looped upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · budget · coupons). Constructed checks → 13, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
