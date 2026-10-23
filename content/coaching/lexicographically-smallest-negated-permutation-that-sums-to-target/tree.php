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
            'message' => "Read the problem statement above.\nFeasibility?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|target| ≤ S and S − target even', 'next' => 's2'],
                ['label' => 'Only |target| ≤ S', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): n = 3, target = 1 → [−2, 1, 3] (sum 2) instead of [].\nStep back to when you skipped parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which numbers to negate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest first', 'next' => 'wrong_b'],
                ['label' => 'Largest first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [−2, −1, 3] instead of [−3, 1, 2].\nStep back to when you started small.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [−3, 1, 2], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
