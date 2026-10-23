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
            'message' => "Read the problem statement above.\nRules?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd swap, then the every-6th-game swap', 'next' => 's2'],
                ['label' => 'Odd swap only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 6 instead of 4.\nStep back to when you skipped the 6th-game rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "6th games?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices 0, 6, 12, …', 'next' => 'wrong_b'],
                ['label' => 'Indices 5, 11, 17, …', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → −6 instead of 4.\nStep back to when you shifted the index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 0, 4, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
