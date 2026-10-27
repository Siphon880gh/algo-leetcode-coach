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
            'message' => "State:\ndp = [0, 0, 0, 0, 0]\nitem (2, 3), unlimited copies\nW = 4\n\nWhat is the first forward update, at c = 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[2] = 3', 'next' => 'mid'],
                ['label' => 'dp[2] = 6 already', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nOnly one copy fits in capacity 2, so the first value written is 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ndp[2] = 3\nnext, c = 4\n\nWhat is dp[4]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '6, reusing dp[2] + 3', 'next' => 'ask'],
                ['label' => '3, because you cannot reuse the item', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThe forward scan reuses the item on purpose. 3 + 3 = 6.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'ask' => [
            'message' => "State:\nnow suppose the item can be used only once (0-1)\n\nWhat is the best value for W = 4?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3, because only one copy is allowed', 'next' => 'success'],
                ['label' => '6, still from two copies', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe 0-1 rule allows a single copy, so the best is 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Scanning forward stacks copies, reaching 6.\n- The 0-1 rule would stop at 3.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
