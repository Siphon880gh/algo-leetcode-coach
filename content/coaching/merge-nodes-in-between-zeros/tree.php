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
            'message' => "Read the problem statement above.\nThe first node (a 0)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it: nothing before it', 'next' => 's2'],
                ['label' => 'Emit a node for it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The result would start with a 0, which must not appear.\nStep back to when you emitted for the first zero.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At each later 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Emit the running sum and keep it', 'next' => 'wrong_b'],
                ['label' => 'Emit the sum and reset it to 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [4,15], not [4,11].\nStep back to when you forgot to reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Zero nodes in the output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None', 'next' => 'success'],
                ['label' => 'Keep them as separators', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The modified list must not contain any 0.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [4,11], [1,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
