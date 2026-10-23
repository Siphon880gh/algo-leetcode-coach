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
            'message' => "Read the problem statement above.\nUnrated orders in the average?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip them (AVG ignores NULL)', 'next' => 's2'],
                ['label' => 'Count them as 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Customer 101 averages 3.5 and drops out.\nStep back to when you counted them as 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'average_rating DESC, then customer_id ASC', 'next' => 'wrong_b'],
                ['label' => 'average_rating DESC, then customer_id DESC', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 101 comes before 103.\nStep back to when you sorted IDs up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → 103, 101, 105.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
