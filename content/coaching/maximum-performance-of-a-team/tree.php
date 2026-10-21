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
            'message' => "Read the problem statement above.\nSort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Efficiency descending', 'next' => 's2'],
                ['label' => 'Speed descending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The current engineer must set the minimum efficiency.\nStep back to when you sorted by speed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap exceeds k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop the largest', 'next' => 'wrong_b'],
                ['label' => 'Pop the smallest speed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Keep the fastest engineers.\nStep back to when you popped the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only on the final answer', 'next' => 'success'],
                ['label' => 'On every product', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Reduced products do not compare correctly.\nStep back to when you reduced early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). k = 2 → 60. k = 3 → 68. k = 4 → 72.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
