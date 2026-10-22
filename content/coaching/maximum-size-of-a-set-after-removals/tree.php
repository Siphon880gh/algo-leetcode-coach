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
            'message' => "Read the problem statement above.\nFill a half first with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values only that array has', 'next' => 's2'],
                ['label' => 'Values both arrays have', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Shared values can come from either side; example 2 → 3 instead of 5.\nStep back to when you took shared values first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a + b + c', 'next' => 'wrong_b'],
                ['label' => 'min(min(a, h) + min(b, h) + c, n)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each side keeps only h values; example 2 → 6 instead of 5.\nStep back to when you dropped the caps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 5, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
