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
            'message' => 'State:
prices = [1, 2, 4]
cash = 0
hold = −∞

After seeing price 1, hold?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1 — buy at 1', 'next' => 'mid'],
                ['label' => '1 — somehow profit already', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => 'Wrong.

Buying spends 1. hold becomes −1.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => 'State:
cash=0, hold=−1
price 2 arrives
sell would make cash = hold+2 = 1

New cash?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'ask'],
                ['label' => '0 — never sell early', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => 'Wrong.

max(old cash 0, hold+2)=1. You may sell.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'ask' => [
            'message' => 'State:
after price 4, sell from hold=−1

Final cash?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 — bought 1 sold 4', 'next' => 'success'],
                ['label' => '4 — price itself', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => 'Wrong.

Profit is sell−buy = 3, not the raw price.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Two states: cash and hold
- Walk prices once → profit 3

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
