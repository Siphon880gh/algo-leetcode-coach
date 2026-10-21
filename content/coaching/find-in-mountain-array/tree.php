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
            'message' => "Read the problem statement above.\nScan the array to find the peak?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search with get(mid) < get(mid + 1)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The call limit forbids a linear scan.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search which side first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The falling side', 'next' => 'wrong_b'],
                ['label' => 'The rising side', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The smaller index must win.\nStep back to when you searched the right side first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "On the falling side, get(mid) < target. Move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left', 'next' => 'success'],
                ['label' => 'Right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values decrease to the right.\nStep back to when you moved right.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) calls. [1,2,3,4,5,3,1], target 3 → 2. [0,1,2,4,2,1], target 3 → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
