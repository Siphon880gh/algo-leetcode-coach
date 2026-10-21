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
            'message' => "Read the problem statement above.\nAdding 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the prefix list', 'next' => 's2'],
                ['label' => 'Append 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Later divisions would divide by zero.\nStep back to when you appended 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k ≥ length of the list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divide anyway', 'next' => 'wrong_b'],
                ['label' => 'Return 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The window includes a zero.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Otherwise?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p[−1] / p[−1 − k]', 'next' => 'success'],
                ['label' => 'p[−1] / p[−k]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Off by one.\nStep back to when you used p[−k].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. After 3, 0, 2, 5, 4: (2) → 20, (3) → 40, (4) → 0; then 8, (2) → 32.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
