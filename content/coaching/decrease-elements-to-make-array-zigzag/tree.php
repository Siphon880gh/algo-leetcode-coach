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
            'message' => "Read the problem statement above.\nWhich elements do you lower?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the valleys', 'next' => 's2'],
                ['label' => 'The peaks', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Lowering a peak never helps.\nStep back to when you lowered peaks.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost for a valley at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] − min(neighbours)', 'next' => 'wrong_b'],
                ['label' => 'max(0, nums[i] − min(neighbours) + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A valley must be strictly smaller, and the cost is never negative.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Use the updated neighbour values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the originals', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Neighbours of valleys are peaks, which never change.\nStep back to when you used updated values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3] → 2. [9,6,1,6,2] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
