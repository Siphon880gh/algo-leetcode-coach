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
            'message' => "Read the problem statement above.\nCompare the halves by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digit sums', 'next' => 's2'],
                ['label' => 'Equal digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only the sums must match; example 2 → 1 instead of 4.\nStep back to when you compared digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd digit counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split at n // 2', 'next' => 'wrong_b'],
                ['label' => 'Never symmetric', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 101 would count; 1 … 1000 → 63 instead of 9.\nStep back to when you split odd lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((high − low) · d). Examples → 9, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
