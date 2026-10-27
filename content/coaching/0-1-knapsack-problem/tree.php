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
            'message' => "State:\nbag capacity W = 4\nitems: (1, 15), (3, 20), (4, 30)\neach item can be used at most once\nthe bag starts empty\n\nWhat is the best total value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35, by taking (1, 15) and (3, 20)', 'next' => 'ask_loop'],
                ['label' => '30, by taking only the weight-4 item', 'next' => 'w_30'],
            ],
        ],
        'w_30' => [
            'message' => "Wrong.\n\n15 + 20 = 35, which beats 30. The two lighter items fit in the bag together.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'ask_loop' => [
            'message' => "State:\none dp array\nprocessing one item\neach item may be used at most once\n\nWhich way should the capacity loop run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From high capacity down to low (backward)', 'next' => 'ask_fwd'],
                ['label' => 'From low capacity up to high (forward)', 'next' => 'w_fwd'],
            ],
        ],
        'w_fwd' => [
            'message' => "Wrong.\n\nA forward scan lets this item build on a cell it already updated, so it can be used again. That is the unbounded knapsack.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_loop',
            'choices' => [],
        ],
        'ask_fwd' => [
            'message' => "State:\nsuppose you wrongly scan forward with the item (1, 15)\nW = 4\n\nWhat wrong value could dp[4] end up with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '60, from four copies of the weight-1 item', 'next' => 'success'],
                ['label' => '15, because a forward scan cannot change anything', 'next' => 'w_fake'],
            ],
        ],
        'w_fake' => [
            'message' => "Wrong.\n\nA forward scan stacks copies: dp[1] = 15, dp[2] = 30, dp[3] = 45, dp[4] = 60. That is why 0-1 knapsack must go backward.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_fwd',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- The best packing is 35, using two items.\n- The backward loop makes sure each item is used once.\n- A forward loop would wrongly report 60.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
