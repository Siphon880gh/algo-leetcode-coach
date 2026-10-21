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
            'message' => "Read the problem statement above.\nReplacement candidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values from nums1', 'next' => 's2'],
                ['label' => 'Any integer', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only existing nums1 values may be copied.\nStep back to when you allowed any value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find the closest value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan nums1 each time', 'next' => 'wrong_b'],
                ['label' => 'Binary search in sorted nums1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n²).\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After subtracting the saving', 'next' => 'success'],
                ['label' => 'On the total before', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Reducing first can make the subtraction wrong.\nStep back to when you reduced early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 0, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
