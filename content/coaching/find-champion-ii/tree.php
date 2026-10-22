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
            'message' => "Read the problem statement above.\nSeveral nodes with in-degree 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Return the smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. No one is stronger than all; example 2 → 0 instead of −1.\nStep back to when you returned the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Nodes with no edges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only nodes that appear in edges', 'next' => 'wrong_b'],
                ['label' => 'Include them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 3 with only edge 0 → 1 → 0 instead of −1.\nStep back to when you skipped isolated nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 0, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
