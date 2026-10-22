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
            'message' => "Read the problem statement above.\nPath through the new edge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌈d1 / 2⌉ + ⌈d2 / 2⌉ + 1', 'next' => 's2'],
                ['label' => '⌊d1 / 2⌋ + ⌊d2 / 2⌋ + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the path through the edge', 'next' => 'wrong_b'],
                ['label' => 'Max with d1 and d2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 10-edge path and a single node → 6 instead of 10.\nStep back to when you dropped the old diameters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 3, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
