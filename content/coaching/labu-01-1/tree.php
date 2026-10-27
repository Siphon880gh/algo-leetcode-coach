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
            'message' => "State:\nbag capacity W = 4\nitems: A (1, 15), B (3, 20), C (4, 30)\neach item can be used at most once\nthe table starts as all zeros (no items)\n\nUsing only A, what is dp[1][4]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '15, by taking A once', 'next' => 'after_a'],
                ['label' => '60, from four copies of A', 'next' => 'w_copies'],
            ],
        ],
        'w_copies' => [
            'message' => "Wrong.\n\nIn 0-1 knapsack, A is available once. Capacity 4 still holds only one A, which is 15.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_a' => [
            'message' => "State:\nthe row for A is filled\nnow add B (3, 20)\nat capacity 4: skip gives 15, take gives dp[1][1] + 20 = 15 + 20\n\nWhat is dp[2][4]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35, by taking A and B', 'next' => 'ask_c'],
                ['label' => '20, by taking B alone', 'next' => 'w_b'],
            ],
        ],
        'w_b' => [
            'message' => "Wrong.\n\nThe better of skip (15) and take (35) is 35. A still fits next to B.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_a',
            'choices' => [],
        ],
        'ask_c' => [
            'message' => "State:\ndp[2][4] = 35\nnow item C (4, 30)\ntaking C gives dp[2][0] + 30 = 30\n\nWhat is the final dp[3][4]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35, keeping A and B, because C is worse', 'next' => 'success'],
                ['label' => '30, because you must take the heaviest item', 'next' => 'w_c'],
            ],
        ],
        'w_c' => [
            'message' => "Wrong.\n\nSkipping C keeps 35, and taking C alone gives 30. Keep the better option, which is skip.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_c',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- The row for no items is all zeros.\n- In 0-1 knapsack, the take option reads only the previous row.\n- The best packing here is 35.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
