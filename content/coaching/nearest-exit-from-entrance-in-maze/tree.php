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
            'message' => "Read the problem statement above.\nSearch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS', 'next' => 's2'],
                ['label' => 'DFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. DFS does not find shortest paths.\nStep back to when you used DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Entrance on the border?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'wrong_b'],
                ['label' => 'Not an exit', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement excludes the entrance.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mark visited when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On push', 'next' => 'success'],
                ['label' => 'On pop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Cells get queued many times.\nStep back to when you marked on pop.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 1, 2, -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
