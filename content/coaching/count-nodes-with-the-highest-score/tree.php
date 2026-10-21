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
            'message' => "Read the problem statement above.\nPieces left after removing u?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each child subtree plus the rest of the tree', 'next' => 's2'],
                ['label' => 'Only the child subtrees', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The part above u, of size n − size[u], is a piece too.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply by n − size = 0', 'next' => 'wrong_b'],
                ['label' => 'No upper piece: use 1 instead of n − size', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That would make the root's score 0.\nStep back to when you multiplied by 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Score type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Products of three sizes near n/3 exceed 3 · 10^13.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
