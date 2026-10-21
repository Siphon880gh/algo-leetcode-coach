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
            'message' => "Read the problem statement above.\nItems with group −1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each gets a fresh group', 'next' => 's2'],
                ['label' => 'All share group −1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. They would be forced to sit together.\nStep back to when you shared −1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Dependency between different groups becomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An edge between the items only', 'next' => 'wrong_b'],
                ['label' => 'An edge between the groups', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Whole groups must come before others.\nStep back to when you kept item edges only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A sort does not visit every node. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[]', 'next' => 'success'],
                ['label' => 'The partial order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A cycle means no valid order.\nStep back to when you returned a partial order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m + E). Example 1 → e.g. [6,3,4,1,5,2,0,7]. Example 2 → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
