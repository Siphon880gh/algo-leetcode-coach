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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Work on distinct values with a counter', 'next' => 's2'],
                ['label' => 'Count all index pairs i < j with |a − b| = k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counting index pairs counts duplicates. [3,1,4,1,5], 2 would count (1,3) twice.\nStep back to when you counted index pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k > 0.\nHow do you count each pair once?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1 for x − k and 1 for x + k', 'next' => 'wrong_b'],
                ['label' => 'For each distinct x, add 1 if x + k is present', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Checking both x − k and x + k counts each pair from both ends.\nStep back to when you checked both directions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "O(n) with a hash counter. Sort + two pointers also works.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct x + k lookups; k = 0 → count ≥ 2', 'next' => 'success'],
                ['label' => 'Use the same x + k rule when k = 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With k = 0, x + 0 = x is always present. Every distinct value would count.\nStep back to when you used the general rule for k = 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Counter, one direction, special k = 0. [3,1,4,1,5], 2 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
