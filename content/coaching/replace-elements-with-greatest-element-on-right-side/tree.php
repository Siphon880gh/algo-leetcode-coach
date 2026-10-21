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
            'message' => "Read the problem statement above.\nSweep direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left', 'next' => 's2'],
                ['label' => 'Left to right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer depends on the suffix.\nStep back to when you went left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Initial max?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '−1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last element must become −1.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Write first or update first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write, then update', 'next' => 'success'],
                ['label' => 'Update, then write', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An element is not on its own right.\nStep back to when you updated first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [17,18,5,4,6,1] → [18,6,6,6,1,-1]. [400] → [-1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
