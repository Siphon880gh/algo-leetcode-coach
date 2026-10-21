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
            'message' => "Read the problem statement above.\nAssign or insert?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insert', 'next' => 's2'],
                ['label' => 'Assign target[index[i]]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Existing elements must shift.\nStep back to when you assigned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of processing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left', 'next' => 'wrong_b'],
                ['label' => 'Left to right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement processes pairs in order.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is O(n²) fine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: n ≤ 100', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The input is tiny.\nStep back to when you optimized needlessly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [0,1,2,3,4], [0,1,2,2,1] → [0,4,1,3,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
