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
            'message' => "Problem: Given a list of phone numbers as digit strings, return true if no number is a prefix of another, and false otherwise. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The strings themselves', 'next' => 's2'],
                ['label' => 'Length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 12] → true instead of false.\nStep back to when you sorted by length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Current starts with the next', 'next' => 'wrong_b'],
                ['label' => 'Next starts with the current', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [9, 93, 71] → true instead of false.\nStep back to when you reversed the test.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n · L). Checks → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
