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
            'message' => "Read the problem statement above.\nSort first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A large coin early would stop the scan too soon.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extend condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c < r', 'next' => 'wrong_b'],
                ['label' => 'c ≤ r', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A coin equal to r makes exactly the missing value r.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Initial r?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 (value 0 is makeable)', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The empty selection makes 0.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 8, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
