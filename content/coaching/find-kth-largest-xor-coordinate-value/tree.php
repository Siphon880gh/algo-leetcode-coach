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
            'message' => "Read the problem statement above.\nOverlap term?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR P[i][j] once more', 'next' => 's2'],
                ['label' => 'Subtract P[i][j]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. XOR cancels by repetition, not subtraction.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "kth largest of up to 10^6 values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recompute per k', 'next' => 'wrong_b'],
                ['label' => 'Sort, quickselect or a size-k min-heap', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Gather once, then select.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "1-indexed k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sorted descending [k − 1]', 'next' => 'success'],
                ['label' => 'sorted descending [k]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. k = 1 is the largest.\nStep back to when you used [k].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n log(m · n)). Examples → 7, 5, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
