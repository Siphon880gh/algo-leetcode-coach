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
            'message' => "Read the problem statement above.\nb frequency 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not allowed', 'next' => 's2'],
                ['label' => 'Allowed (0 is even)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of −1.\nStep back to when you allowed 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letter pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only a < b', 'next' => 'wrong_b'],
                ['label' => 'Every ordered pair', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → −1 instead of 1.\nStep back to when you used a < b.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(20 · n). Examples → −1, 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
