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
            'message' => "State:\ndp = [0, 0, 0, 0, 0]\nW = 4\nitem (1, 15), unlimited copies\n\nAfter a forward scan with this item, what is dp[4]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '60, from four stacked copies', 'next' => 'ask_dir'],
                ['label' => '15, from only one copy', 'next' => 'w_one'],
            ],
        ],
        'w_one' => [
            'message' => "Wrong.\n\nForward updates let dp[1] = 15 feed dp[2] = 30, and so on up to dp[4] = 60.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'ask_dir' => [
            'message' => "State:\nunlimited copies\none dp array\n\nWhich way does the capacity loop go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From low to high (forward)', 'next' => 'ask_vs'],
                ['label' => 'From high to low (backward)', 'next' => 'w_dir'],
            ],
        ],
        'w_dir' => [
            'message' => "Wrong.\n\nBackward is the 0-1 pattern. Forward lets copies stack.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_dir',
            'choices' => [],
        ],
        'ask_vs' => [
            'message' => "State:\nnow suppose each item can be used at most once (0-1)\nW = 4\n\nWhat is the best value then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35, for example (1, 15) plus (3, 20), not 60', 'next' => 'success'],
                ['label' => '60, because repeats are still allowed', 'next' => 'w_01'],
            ],
        ],
        'w_01' => [
            'message' => "Wrong.\n\nThe 0-1 rule forbids stacking the weight-1 item, so the best drops to 35.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_vs',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A forward loop stacks copies, reaching 60 here.\n- The 0-1 rule would stop at 35.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
