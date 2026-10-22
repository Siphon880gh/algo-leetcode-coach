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
            'message' => "Read the problem statement above.\nNegative tail?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You must take it', 'next' => 's2'],
                ['label' => 'Drop it with max(0, …)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. You cannot stop early: example 1 → 5 instead of 3.\nStep back to when you dropped the tail.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Starting points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first k', 'next' => 'wrong_b'],
                ['label' => 'Every index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → −3 instead of −1.\nStep back to when you limited the starts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
