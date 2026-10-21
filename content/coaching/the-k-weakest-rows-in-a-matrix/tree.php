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
            'message' => "Read the problem statement above.\nTie on soldier count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller index first', 'next' => 's2'],
                ['label' => 'Larger index first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The smaller index is weaker.\nStep back to when you put the larger first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count soldiers by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Summing columns', 'next' => 'wrong_b'],
                ['label' => 'Binary search for the first 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Soldiers are per row, and rows are sorted.\nStep back to when you summed columns.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Row indices', 'next' => 'success'],
                ['label' => 'Soldier counts', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer lists rows.\nStep back to when you returned counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log n + m log m). First example, k = 3 → [2,0,3]. Second, k = 2 → [0,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
