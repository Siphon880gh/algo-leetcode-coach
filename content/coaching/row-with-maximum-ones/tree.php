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
            'message' => "Read the problem statement above.\nSwitch to row i when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its count is strictly larger', 'next' => 's2'],
                ['label' => 'Its count is at least as large', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ties go to the smaller index; [[0,0],[1,1],[1,1]] → [2,2] instead of [1,2].\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[count, row index]', 'next' => 'wrong_b'],
                ['label' => '[row index, count]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The index comes first; Example 2 → [2,1] instead of [1,2].\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → [0,1], [1,2], [1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
