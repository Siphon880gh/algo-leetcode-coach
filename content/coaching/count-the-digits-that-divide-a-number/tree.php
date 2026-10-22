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
            'message' => "Read the problem statement above.\nTest each digit against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The original num', 'next' => 's2'],
                ['label' => 'The shrinking copy x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x is no longer num; num = 32 → 2 instead of 1, since 3 divides 3 but not 32.\nStep back to when you tested against x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A digit repeats?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each distinct digit once', 'next' => 'wrong_b'],
                ['label' => 'Count it each time', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every digit counts; Example 2, 121 → 1 instead of 2.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). Examples → 1, 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
