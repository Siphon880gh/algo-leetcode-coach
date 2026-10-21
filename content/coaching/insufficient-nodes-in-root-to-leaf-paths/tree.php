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
            'message' => "Read the problem statement above.\nTest inner nodes against limit directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only full root-to-leaf sums count', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A small inner sum can grow along the path.\nStep back to when you tested inner nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An inner node lost both children. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Test it as a new leaf', 'next' => 'wrong_b'],
                ['label' => 'Remove it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every path through it already failed.\nStep back to when you tested it as a leaf.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Decide a node before or after its children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After', 'next' => 'success'],
                ['label' => 'Before', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Its fate depends on whether a child survives.\nStep back to when you decided first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4,−99,−99,7,8,9,−99,−99,12,13,−99,14], limit 1 → [1,2,3,4,null,null,7,8,9,null,14]. [5,4,8,11,null,17,4,7,1,null,null,5,3], limit 22 → [5,4,8,11,null,17,4,7,null,null,null,5]. [1,2,−3,−5,null,4,null], limit −1 → [1,null,−3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
