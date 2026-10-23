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
            'message' => "Read the problem statement above.\nLeave C empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, split the rest between A and C', 'next' => 's2'],
                ['label' => 'Yes, A gets the whole rest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 14 instead of 15.\nStep back to when you left C empty.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Build the basis from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r itself', 'next' => 'wrong_b'],
                ['label' => 'r & ~X', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 11 instead of 5.\nStep back to when you dropped the mask.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n · log M). Examples → 5, 6, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
