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
            'message' => "Read the problem statement above.\nToggle edge (v, c) when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The subtree of c has an odd mismatch count', 'next' => 's2'],
                ['label' => 'c itself mismatches', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [2, 5] instead of [1, 2, 5].\nStep back to when you looked at one node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Impossible when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never', 'next' => 'wrong_b'],
                ['label' => 'The whole count is odd', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [0] instead of [−1].\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [0], [1, 2, 5], [−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
