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
            'message' => "Read the problem statement above.\nTraversal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In-order', 'next' => 's2'],
                ['label' => 'Pre-order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only in-order is sorted for a BST.\nStep back to when you used pre-order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Concatenate and sort', 'next' => 'wrong_b'],
                ['label' => 'Two-pointer merge', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sorting again wastes the order you have.\nStep back to when you re-sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep both', 'next' => 'success'],
                ['label' => 'Deduplicate', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every element appears.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). [2,1,4] and [1,0,3] → [0,1,1,2,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
