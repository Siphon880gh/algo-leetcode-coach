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
            'message' => "Read the problem statement above.\nDo you need a visited set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the graph is acyclic, so paths cannot loop', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A global visited set would block nodes that other paths share.\nStep back to when you added one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You reach n − 1. What do you save?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The path list itself', 'next' => 'wrong_b'],
                ['label' => 'A copy of the current path', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later pops would change the saved list.\nStep back to when you saved the live list.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After exploring a neighbor, then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop it from the path', 'next' => 'success'],
                ['label' => 'Leave it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The path must reflect only the current route.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2ⁿ · n). [[1,2],[3],[3],[]] → [[0,1,3],[0,2,3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
