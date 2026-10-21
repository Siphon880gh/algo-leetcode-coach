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
            'message' => "Read the problem statement above.\nSubarrays containing index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(i + 1)(n − i)', 'next' => 's2'],
                ['label' => 'n − i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The start can also vary to the left.\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many are odd length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊total / 2⌋', 'next' => 'wrong_b'],
                ['label' => '⌈total / 2⌉', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Odd lengths are the larger half.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Complexity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n³)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One pass with the formula suffices.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [1,4,2,5,3] → 58. [1,2] → 3. [10,11,12] → 66.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
