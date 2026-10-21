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
            'message' => "Read the problem statement above.\nA difficulty appears once?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Spend one round on it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A round takes 2 or 3 tasks; Example 2 → 2 instead of −1.\nStep back to when you allowed a single task.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rounds for count c ≥ 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Threes first; remainder 1 means impossible', 'next' => 'wrong_b'],
                ['label' => '⌈c / 3⌉', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A count of 4 is 2 + 2, so [1,1,1,1] → −1 instead of 2.\nStep back to when you used threes only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine difficulties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the rounds', 'next' => 'success'],
                ['label' => 'Take the largest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each round holds one difficulty; Example 1 → 2 instead of 4.\nStep back to when you took the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
