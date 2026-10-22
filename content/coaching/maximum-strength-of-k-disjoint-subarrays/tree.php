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
            'message' => "Read the problem statement above.\nWeight of subarray j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(k − j + 1), sign alternating', 'next' => 's2'],
                ['label' => 'Sign alternating only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is a different objective: example 1 → 9 instead of 22.\nStep back to when you dropped the factor.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Extend or start the next', 'next' => 'wrong_b'],
                ['label' => 'Extend, start the next, or skip', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without skipping, every element is covered: example 3 → −6 instead of −1.\nStep back to when you removed the skip.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n k). Examples → 22, 64, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
