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
            'message' => "Read the problem statement above.\nMedian definition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr[(n − 1) / 2] after sorting', 'next' => 's2'],
                ['label' => 'Average of the middle two', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement uses the lower middle element.\nStep back to when you averaged.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal strength?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller value is stronger', 'next' => 'wrong_b'],
                ['label' => 'Larger value is stronger', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties go to the larger value.\nStep back to when you took the smaller.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where are the strongest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the ends of the sorted array', 'next' => 'success'],
                ['label' => 'Near the median', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Distance from m grows outward.\nStep back to when you searched the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,2,3,4,5], 2 → [5,1]. [1,1,3,5,5], 2 → [5,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
