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
            'message' => "Read the problem statement above.\nOdd means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'amount is odd', 'next' => 's2'],
                ['label' => 'transaction_id is odd', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 2024-07-01 → odd 225 instead of 75.\nStep back to when you used the id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Days without odd amounts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Filter odd rows in WHERE first', 'next' => 'wrong_b'],
                ['label' => 'CASE … ELSE 0 inside SUM', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 2024-07-02 and 2024-07-03 then have no odd row, so they get no 0.\nStep back to when you filtered first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Example → (75, 350), (0, 350), (0, 120).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
