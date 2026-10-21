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
            'message' => "Read the problem statement above.\nDecode from the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: what a bit means depends on what came before it', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A 0 at the end might be the second half of 10.\nStep back to when you started from the end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "bits[i] == 1. Step by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 1 starts the two-bit characters 10 or 11.\nStep back to when you stepped 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When is the last character one bit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the walk lands exactly on index n − 1', 'next' => 'success'],
                ['label' => 'When the last bit is 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last bit is always 0; it may belong to 10.\nStep back to when you checked the last bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,0] → true. [1,1,1,0] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
