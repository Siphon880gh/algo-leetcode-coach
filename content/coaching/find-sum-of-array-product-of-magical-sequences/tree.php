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
            'message' => "Read the problem statement above.\nCount orderings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Weight by m! / Π c!', 'next' => 's2'],
                ['label' => 'Count each multiset once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 85 instead of 170.\nStep back to when you dropped the multinomial.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the last index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore the carry', 'next' => 'wrong_b'],
                ['label' => 'Add the set bits of the leftover carry', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. m = 2, k = 1, nums = [3] → 0 instead of 9.\nStep back to when you dropped the carry.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m³ · k). Examples → 991600007, 170, 28.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
