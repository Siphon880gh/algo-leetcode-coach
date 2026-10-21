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
            'message' => "Read the problem statement above.\nWhen do you mark a cell as visited?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before exploring its neighbors', 'next' => 's2'],
                ['label' => 'After all neighbors return', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Neighbors would revisit it and recurse forever.\nStep back to when you marked late.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which neighbors connect?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 8 including diagonals', 'next' => 'wrong_b'],
                ['label' => 'Up, down, left, right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Islands are 4-directionally connected.\nStep back to when you added diagonals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No land at all. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '-1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The maximum area over no islands is 0.\nStep back to when you returned -1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Each cell is filled once: O(m · n). [[0,0,0,0,0,0,0,0]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
