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
            'message' => "Read the problem statement above.\nEnumerate subarrays and track their max?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count them by run lengths', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many subarrays ending at i have all elements ≤ B?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => 'The length of the run of elements ≤ B ending at i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every start inside that run works.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you get max in [left, right]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count(right) − count(left − 1)', 'next' => 'success'],
                ['label' => 'count(right) − count(left)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Subtracting count(left) removes subarrays whose max is exactly left.\nStep back to when you used count(left).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,1,4,3], left = 2, right = 3 → 3. [2,9,2,5,6], left = 2, right = 8 → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
