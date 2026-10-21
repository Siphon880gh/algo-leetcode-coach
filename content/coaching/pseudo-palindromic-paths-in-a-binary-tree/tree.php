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
            'message' => "Read the problem statement above.\nPalindrome permutation test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one odd count', 'next' => 's2'],
                ['label' => 'All counts even', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Odd-length paths allow one odd count.\nStep back to when you required all even.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every node', 'next' => 'wrong_b'],
                ['label' => 'Leaves only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Paths run root to leaf.\nStep back to when you checked inner nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "At most one bit set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'mask & (mask − 1) == 0', 'next' => 'success'],
                ['label' => 'mask == 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That rejects one odd count.\nStep back to when you required 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,3,1,3,1,null,1] → 2. [9] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
