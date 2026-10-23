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
            'message' => "Read the problem statement above.\nA new element on its own?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts as a new subsequence (+1)', 'next' => 's2'],
                ['label' => 'Only extends existing ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 0 instead of 14.\nStep back to when you skipped the +1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Same parity after a run of 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not allowed', 'next' => 'wrong_b'],
                ['label' => 'Allowed: it makes a run of 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 9 instead of 14.\nStep back to when you banned runs of 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
