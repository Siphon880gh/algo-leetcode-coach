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
            'message' => "Read the problem statement above.\nDigit extraction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n % k, then n //= k', 'next' => 's2'],
                ['label' => 'Convert to a base-10 string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The digits must be in base k.\nStep back to when you used base 10.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum interpreted how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As a base-k number', 'next' => 'wrong_b'],
                ['label' => 'Each digit as a base-10 number', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement sums the digits in base 10.\nStep back to when you reinterpreted the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Loop end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n == 0', 'next' => 'success'],
                ['label' => 'n < k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stopping at n < k skips the leading digit.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log_k n). Examples → 9, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
