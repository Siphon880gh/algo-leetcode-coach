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
            'message' => "Read the problem statement above.\nValid triangle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a + b > c strictly', 'next' => 's2'],
                ['label' => 'a + b ≥ c', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [0, 0, 180] instead of [].\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Units?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Radians', 'next' => 'wrong_b'],
                ['label' => 'Degrees', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [0.6435, 0.9273, 1.5708] instead of [36.8699, 53.1301, 90].\nStep back to when you skipped the conversion.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → [36.8699, 53.1301, 90], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
