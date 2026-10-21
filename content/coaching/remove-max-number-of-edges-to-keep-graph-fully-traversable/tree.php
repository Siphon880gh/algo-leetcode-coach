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
            'message' => "Read the problem statement above.\nWhich edges first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Type 3 (shared)', 'next' => 's2'],
                ['label' => 'Type 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One shared edge can replace two private ones.\nStep back to when you started with type 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge joins nothing new?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it', 'next' => 'wrong_b'],
                ['label' => 'It is removable', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Redundant edges are exactly the ones to remove.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A DSU not fully connected?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return removed count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That person cannot traverse the graph.\nStep back to when you returned the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E α(n)). Example 1 → 2. Example 2 → 0. Example 3 → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
