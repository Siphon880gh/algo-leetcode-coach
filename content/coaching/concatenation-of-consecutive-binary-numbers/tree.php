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
            'message' => "Read the problem statement above.\nBuild the binary string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: shift numerically', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It has over a million bits for n = 10^5.\nStep back to when you built a string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does bit length grow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every step', 'next' => 'wrong_b'],
                ['label' => 'When i is a power of two', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bit length changes only at 2, 4, 8, ….\nStep back to when you grew it each step.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After every step', 'next' => 'success'],
                ['label' => 'Only at the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The number grows without bound.\nStep back to when you delayed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 1 → 1, n = 3 → 27, n = 12 → 505379714.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
