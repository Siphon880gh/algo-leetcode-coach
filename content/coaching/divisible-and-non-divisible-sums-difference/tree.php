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
            'message' => "Read the problem statement above.\nFrom the total, subtract the multiples?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Twice', 'next' => 's2'],
                ['label' => 'Once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Once gives num1 only; example 1 → 37 instead of 19.\nStep back to when you subtracted once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum of multiples of m up to n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'q(q + 1)/2', 'next' => 'wrong_b'],
                ['label' => 'm · q(q + 1)/2, q = n div m', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That forgets the factor m; example 1 → 43 instead of 19.\nStep back to when you dropped m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 19, 15, −15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
