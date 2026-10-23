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
            'message' => "Read the problem statement above.\nJoin condition on the second copy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same user_id and a.product_id < b.product_id', 'next' => 's2'],
                ['label' => 'Same user_id and a.product_id <> b.product_id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each pair appears twice: 6 rows instead of 3 on the example.\nStep back to when you used <>.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep pairs with at least 3 customers where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE COUNT(*) >= 3', 'next' => 'wrong_b'],
                ['label' => 'HAVING COUNT(*) >= 3', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. SQL does not allow an aggregate in WHERE; SQLite reports misuse of aggregate: COUNT().\nStep back to when you filtered in WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → (101, 102), (101, 103), (102, 104), each with 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
