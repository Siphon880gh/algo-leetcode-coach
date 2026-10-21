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
            'message' => "Read the problem statement above.\nDuplicates in the middle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each copy counts', 'next' => 's2'],
                ['label' => 'Count each value once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 [-3,3,3,90] → 2, not 1.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Copies of the minimum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count a copy when another equal value exists', 'next' => 'wrong_b'],
                ['label' => 'Never count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The smaller element must be strictly smaller; [1,1,2] → 0.\nStep back to when you counted a minimum copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All values equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Return n − 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No element has anything strictly smaller; [5,5,5] → 0.\nStep back to when you returned n − 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
