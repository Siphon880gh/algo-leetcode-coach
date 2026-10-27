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
            'message' => "State:\nitem with weight 2 and value 3\nW = 4\nrule: each item at most once\n\nWhat is the best value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3, from one copy with capacity 2 left over', 'next' => 'ask_unb'],
                ['label' => '6, from two copies anyway', 'next' => 'w_01'],
            ],
        ],
        'w_01' => [
            'message' => "Wrong.\n\nThe 0-1 rule forbids a second copy. The best is 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'ask_unb' => [
            'message' => "State:\nthe item is still weight 2 and value 3, with W = 4\nrule: unlimited copies\n\nWhat is the best value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '6, from two copies', 'next' => 'ask_loop'],
                ['label' => '3, from one copy', 'next' => 'w_unb'],
            ],
        ],
        'w_unb' => [
            'message' => "Wrong.\n\nWith unlimited copies, two items of weight 2 fit, for a value of 6.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_unb',
            'choices' => [],
        ],
        'ask_loop' => [
            'message' => "State:\none dp array\nunlimited copies of this item\n\nWhich way does the capacity loop go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Forward, from low to high, so copies stack', 'next' => 'success'],
                ['label' => 'Backward, from high to low, as in 0-1', 'next' => 'w_loop'],
            ],
        ],
        'w_loop' => [
            'message' => "Wrong.\n\nA backward loop blocks reuse. A forward loop lets dp[2] = 3 feed dp[4] = 6.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_loop',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Decide the copy rule first: once, unlimited, or at most k.\n- The loop direction controls reuse.\n- One item gives three different answers under the three rules.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
