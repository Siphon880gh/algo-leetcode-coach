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
            'message' => "Read the problem statement above.\nInsert a zero and pop the last element each time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: that is O(n²)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each insert shifts the rest.\nStep back to when you inserted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Copy front to back or back to front?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Front to back', 'next' => 'wrong_b'],
                ['label' => 'Back to front', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You would overwrite values before reading them.\nStep back to when you went forward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The write index is past the end. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the write, keep moving', 'next' => 'success'],
                ['label' => 'Stop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Later elements still need to be placed.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,2,3,0,4,5,0] → [1,0,0,2,3,0,0,4]. [1,2,3] → [1,2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
