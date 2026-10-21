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
            'message' => "Read the problem statement above.\nCompare the max with every element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: beating the runner-up is enough', 'next' => 's2'],
                ['label' => 'Yes, in a second loop', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That works but takes a second pass; if max ≥ 2 · second, it beats everyone smaller too.\nStep back to when you checked every element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A new x exceeds first. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'first = x only', 'next' => 'wrong_b'],
                ['label' => 'second = first, first = x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The old maximum becomes the runner-up.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return when it qualifies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The index of the largest', 'next' => 'success'],
                ['label' => 'The largest value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for the index.\nStep back to when you returned the value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,6,1,0] → 1. [1,2,3,4] → -1. [1] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
