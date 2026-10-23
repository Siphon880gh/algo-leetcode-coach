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
            'message' => "Read the problem statement above.\nNext floor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Decided by the interval DP', 'next' => 's2'],
                ['label' => 'Always the nearest unserved floor', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): start = 8, requests = [7, 2, 9, 6, 8] → 20 instead of 16.\nStep back to when you went to the nearest floor.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost of one second?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 (shortest route)', 'next' => 'wrong_b'],
                ['label' => 'Number of requests still waiting', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 28 instead of 22.\nStep back to when you minimised distance.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m²). Examples → 6, 10, 22.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
