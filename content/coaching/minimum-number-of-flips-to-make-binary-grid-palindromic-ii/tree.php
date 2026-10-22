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
            'message' => "Read the problem statement above.\nA group of four costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(ones, 4 − ones)', 'next' => 's2'],
                ['label' => 'ones (clear it)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1, 1], [1, 0]] → 3 instead of 1.\nStep back to when you cleared every group.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only make each pair match', 'next' => 'wrong_b'],
                ['label' => 'Fix the count mod 4', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 0 instead of 2.\nStep back to when you skipped mod 4.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → 3, 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
