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
            'message' => "Problem: Given an integer n, return whether it equals the sum of its digits, each raised to the power of the number of digits. (Restated from memory; limits and examples may differ slightly.)\nRaise each digit to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k, the digit count', 'next' => 's2'],
                ['label' => '3 always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The power is the number of digits.\nStep back to when you used 3.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you get k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n // 10', 'next' => 'wrong_b'],
                ['label' => 'len(str(n))', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That drops a digit, it does not count them.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare the sum with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The original n', 'next' => 'success'],
                ['label' => 'The last remainder', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Keep a copy of n before peeling digits.\nStep back to when you lost n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). 153 → true (1 + 125 + 27). 123 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
