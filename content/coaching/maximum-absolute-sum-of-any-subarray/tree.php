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
            'message' => "Read the problem statement above.\nInclude the empty prefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, start max and min at 0', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Subarrays starting at index 0 need prefix 0.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Does the order of max and min matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, min must come first', 'next' => 'wrong_b'],
                ['label' => 'No: either order gives the same absolute value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A reversed order is a very negative subarray with the same absolute value.\nStep back to when you enforced order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Kadane for max and for min', 'next' => 'success'],
                ['label' => 'Sort the array', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting destroys contiguity.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1). Examples → 5, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
