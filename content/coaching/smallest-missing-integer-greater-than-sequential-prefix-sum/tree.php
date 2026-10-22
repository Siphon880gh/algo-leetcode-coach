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
            'message' => "Read the problem statement above.\nSequential means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each next value is previous + 1', 'next' => 's2'],
                ['label' => 'Each next value is larger', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 4] → 7 instead of 3.\nStep back to when you accepted any increase.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start the search at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum + 1', 'next' => 'wrong_b'],
                ['label' => 'The sum itself', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Greater than or equal; example 1 → 7 instead of 6.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
