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
            'message' => "Read the problem statement above.\nHow often does each digit fill a place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c^(k − 1) times', 'next' => 's2'],
                ['label' => 'Once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 33 instead of 66.\nStep back to when you dropped c^(k − 1).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Place weight sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10^k − 1', 'next' => 'wrong_b'],
                ['label' => '(10^k − 1) / 9', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 594 instead of 66.\nStep back to when you skipped the division by 9.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log k). Examples → 66, 444, 555555520.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
