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
            'message' => "Read the problem statement above.\nInfection spreads to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Children and the parent', 'next' => 's2'],
                ['label' => 'Children only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of 4.\nStep back to when you only went down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Number of nodes − 1', 'next' => 'wrong_b'],
                ['label' => 'Largest distance from start', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Several nodes get infected each minute; Example 1 → 7 instead of 4.\nStep back to when you counted nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Traversal on a 10^5-node path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Iterative BFS or an explicit stack', 'next' => 'success'],
                ['label' => 'Plain recursion', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Depth 10^5 overflows Python’s default limit of 1000 and can overflow other stacks.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
