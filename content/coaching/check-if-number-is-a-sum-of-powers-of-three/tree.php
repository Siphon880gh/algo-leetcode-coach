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
            'message' => "Read the problem statement above.\nWhy base 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct powers = digits 0 or 1', 'next' => 's2'],
                ['label' => 'Any digit works', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A digit 2 would need the same power twice.\nStep back to when you allowed 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract 1 repeatedly', 'next' => 'wrong_b'],
                ['label' => 'while n: check n % 3, then n //= 3', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That ignores the power structure.\nStep back to when you subtracted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(log₃ n)', 'next' => 'success'],
                ['label' => 'O(n)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each step divides by 3.\nStep back to when you said O(n).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
