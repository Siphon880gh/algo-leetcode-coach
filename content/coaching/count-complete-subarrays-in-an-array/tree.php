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
            'message' => "Read the problem statement above.\nk is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of distinct values in nums', 'next' => 's2'],
                ['label' => 'The length of nums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Repeats make that unreachable; example 2 → 0 instead of 10.\nStep back to when you used the length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For each end r, add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if some start works', 'next' => 'wrong_b'],
                ['label' => 'l, the number of valid starts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Several starts can work; example 1 → 2 instead of 4.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
