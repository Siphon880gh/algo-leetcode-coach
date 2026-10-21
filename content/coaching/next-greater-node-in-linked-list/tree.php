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
            'message' => "Read the problem statement above.\nScan ahead from every node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one pass with a stack', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you scanned ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does the stack hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values already answered', 'next' => 'wrong_b'],
                ['label' => 'Indices whose answer is still unknown', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Answered nodes are done.\nStep back to when you stored answered values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Top value equals the current value. Pop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the answer must be strictly greater', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal is not greater.\nStep back to when you popped on equal.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,1,5] → [5,5,0]. [2,7,4,3,5] → [7,0,5,5,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
