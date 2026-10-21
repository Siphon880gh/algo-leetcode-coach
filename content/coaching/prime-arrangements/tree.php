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
            'message' => "Read the problem statement above.\nWhere can primes go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only on prime indices (1-indexed)', 'next' => 's2'],
                ['label' => 'Anywhere', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Primes must sit at prime indices.\nStep back to when you placed them anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is 1 prime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Primes start at 2.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine the two groups how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply their factorials', 'next' => 'success'],
                ['label' => 'Add them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The arrangements are independent, so they multiply.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log log n). n = 5 → 12. n = 100 → 682289015.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
