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
            'message' => "Read the problem statement above.\nSwap allowed for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same-parity neighbours', 'next' => 's2'],
                ['label' => 'Any neighbours', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 2 and 1 differ in parity: 21 → 12 instead of 21.\nStep back to when you allowed any pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last one', 'next' => 'wrong_b'],
                ['label' => 'The first one with s[i] > s[i + 1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 45302 instead of 43520.\nStep back to when you took the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 43520, 001.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
