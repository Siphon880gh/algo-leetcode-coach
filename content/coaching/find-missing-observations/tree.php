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
            'message' => "Read the problem statement above.\nSum the missing rolls must reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'mean · (n + m) − sum(rolls)', 'next' => 's2'],
                ['label' => 'mean · n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The known rolls already contribute to the total.\nStep back to when you ignored them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Feasible when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 ≤ need ≤ 6n', 'next' => 'wrong_b'],
                ['label' => 'n ≤ need ≤ 6n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every roll is at least 1, so the sum is at least n.\nStep back to when you allowed sums below n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How to split need into n rolls?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Quotient for all, plus 1 on the first remainder rolls', 'next' => 'success'],
                ['label' => 'Put the excess on one roll', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single roll cannot exceed 6.\nStep back to when you piled it on one roll.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → [6,6], a valid answer such as [3,2,2,2], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
