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
            'message' => "Read the problem statement above.\nWhat is the structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A directed graph: room → the rooms whose keys it holds', 'next' => 's2'],
                ['label' => 'An undirected graph', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A key in room a opens b; that does not let b open a.\nStep back to when you added reverse edges.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Traverse from where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every room', 'next' => 'wrong_b'],
                ['label' => 'Room 0 only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only room 0 is unlocked at the start.\nStep back to when you started everywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whether the visited count equals n', 'next' => 'success'],
                ['label' => 'Whether every key was used', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Keys can be duplicates or useless; what matters is which rooms you reached.\nStep back to when you counted keys.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + keys). [[1],[2],[3],[]] → true. [[1,3],[3,0,1],[2],[0]] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
