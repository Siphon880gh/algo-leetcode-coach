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
            'message' => "Read the problem statement above.\nWhich patterns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(0, 0, 0), (1, 1, 1), (2, 2, 2) and (0, 1, 2)', 'next' => 's2'],
                ['label' => 'Same remainder only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 9.\nStep back to when you dropped (0, 1, 2).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep how many per bucket?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the largest', 'next' => 'wrong_b'],
                ['label' => 'The three largest', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [3, 6, 9] → 0 instead of 18.\nStep back to when you kept one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 9, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
