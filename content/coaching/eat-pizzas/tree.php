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
            'message' => "Read the problem statement above.\nOdd days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌈d / 2⌉ largest pizzas', 'next' => 's2'],
                ['label' => '⌊d / 2⌋', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 3, 4] → 3 instead of 4.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Even days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the next directly', 'next' => 'wrong_b'],
                ['label' => 'Skip one, take the next', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 15 instead of 14.\nStep back to when you skipped nothing.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 14, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
