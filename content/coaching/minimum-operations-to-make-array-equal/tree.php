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
            'message' => "Read the problem statement above.\nTarget value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n (the mean)', 'next' => 's2'],
                ['label' => 'The maximum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Operations preserve the sum.\nStep back to when you aimed for the max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum gaps of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both halves', 'next' => 'wrong_b'],
                ['label' => 'The lower half only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each operation fixes one unit on each side.\nStep back to when you counted both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Loop needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: (n // 2) · ((n + 1) // 2)', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The closed form is O(1).\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). n = 3 → 2. n = 6 → 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
