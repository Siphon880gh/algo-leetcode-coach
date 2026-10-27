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
            'message' => "State:\nW = 4\nitem A (1, 15) may be taken many times\nits row starts as [0, 0, 0, 0, 0]\nfill it from left to right\n\nAfter A, what is the value for capacity 4?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '60, from four copies of A', 'next' => 'ask_take'],
                ['label' => '15, from only one copy', 'next' => 'w_one'],
            ],
        ],
        'w_one' => [
            'message' => "Wrong.\n\nThe complete knapsack allows repeats. Four items of weight 1 fit, which gives 60.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'ask_take' => [
            'message' => "State:\nfilling the cell for item A at capacity 4\nthe take option needs a value that may already include earlier copies of A\n\nWhich cell should it read?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i][c − 1] + 15, in the same row', 'next' => 'ask_skip'],
                ['label' => 'dp[i − 1][c − 1] + 15, in the previous row only', 'next' => 'w_prev'],
            ],
        ],
        'w_prev' => [
            'message' => "Wrong.\n\nReading only the previous row is the 0-1 rule. Reading the same row lets the second copy build on the first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_take',
            'choices' => [],
        ],
        'ask_skip' => [
            'message' => "State:\nskip means \"do not use item A at all\"\n\nWhich cell does skip read?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i − 1][c], in the previous item\'s row', 'next' => 'success'],
                ['label' => 'dp[i][c], which already includes A', 'next' => 'w_skip'],
            ],
        ],
        'w_skip' => [
            'message' => "Wrong.\n\nSkip has to come from the row that never saw this item.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_skip',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- With unlimited copies, the take option reads the same row.\n- Four copies of A fill capacity 4 for a value of 60.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
