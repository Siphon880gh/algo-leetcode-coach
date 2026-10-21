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
            'message' => "Read the problem statement above.\nSecond-half index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + n', 'next' => 's2'],
                ['label' => 'i + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. y_i sits n places later.\nStep back to when you used i + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Naive in-place swaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: values get overwritten', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Use a new array or bit packing.\nStep back to when you swapped in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2n', 'next' => 'success'],
                ['label' => 'n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every element appears once.\nStep back to when you produced n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,5,1,3,4,7], 3 → [2,3,5,4,1,7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
