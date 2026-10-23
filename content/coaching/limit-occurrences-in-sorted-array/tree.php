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
            'message' => "Read the problem statement above.\nCompare with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The kept element k back', 'next' => 's2'],
                ['label' => 'The last kept element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1, 2, 3] instead of [1, 1, 2, 2, 3].\nStep back to when you kept one copy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Free writes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'While w ≤ k', 'next' => 'wrong_b'],
                ['label' => 'While w < k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 1, 1, 2, 2, 3] instead of [1, 1, 2, 2, 3].\nStep back to when you allowed k + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1, 1, 2, 2, 3], [1, 2, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
