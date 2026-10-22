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
            'message' => "Read the problem statement above.\nSuspicious set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All reachable from k', 'next' => 's2'],
                ['label' => 'k and direct callees', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 3, k = 0, [[0, 1], [1, 2]] → [2] instead of [].\nStep back to when you stopped at direct callees.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "If an outside method calls one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove them anyway', 'next' => 'wrong_b'],
                ['label' => 'Remove nothing', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [0, 3] instead of [0, 1, 2, 3].\nStep back to when you removed anyway.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + e). Examples → [0, 1, 2, 3], [3, 4], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
