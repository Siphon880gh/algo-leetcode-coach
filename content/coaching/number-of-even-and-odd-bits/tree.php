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
            'message' => "Read the problem statement above.\nIndex 0 is which bit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The rightmost', 'next' => 's2'],
                ['label' => 'The leftmost', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Bits are indexed from the right; Example 2 → [1,0] instead of [0,1].\nStep back to when you read from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Mask for even indices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0x2AA', 'next' => 'wrong_b'],
                ['label' => '0x555 (bits 0, 2, 4, …)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That mask covers the odd indices; Example 1 → [2,1] instead of [1,2].\nStep back to when you swapped the masks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → [1,2], [0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
