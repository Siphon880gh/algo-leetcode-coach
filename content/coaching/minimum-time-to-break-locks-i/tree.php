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
            'message' => "Read the problem statement above.\nOrder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bitmask DP over broken locks', 'next' => 's2'],
                ['label' => 'Weakest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5 instead of 4.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Factor after j locks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 + j', 'next' => 'wrong_b'],
                ['label' => '1 + k · j', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 6 instead of 5.\nStep back to when you dropped k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n). Examples → 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
