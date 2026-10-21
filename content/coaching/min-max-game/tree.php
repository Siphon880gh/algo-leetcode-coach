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
            'message' => "Read the problem statement above.\nEven new index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min', 'next' => 's2'],
                ['label' => 'max', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 1.\nStep back to when you swapped min and max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Parity of which index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The old index 2i', 'next' => 'wrong_b'],
                ['label' => 'The new index i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 2i is always even, so every step takes the min; [2,2,1,2] → 1 instead of 2.\nStep back to when you used 2i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[2i] and nums[2i + 1]', 'next' => 'success'],
                ['label' => 'nums[i] and nums[i + n / 2]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [2,1,2,2] → 2 instead of 1.\nStep back to when you paired the halves.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
