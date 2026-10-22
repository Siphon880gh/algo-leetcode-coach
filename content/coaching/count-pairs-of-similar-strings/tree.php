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
            'message' => "Read the problem statement above.\nKey each word by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its set of letters', 'next' => 's2'],
                ['label' => 'Its sorted letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Repeats should not matter; Example 2 → 1 instead of 3.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs for a key seen c times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c(c − 1)', 'next' => 'wrong_b'],
                ['label' => 'c(c − 1) / 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. i < j counts each pair once; Example 2 → 6 instead of 3.\nStep back to when you counted ordered pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → 2, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
