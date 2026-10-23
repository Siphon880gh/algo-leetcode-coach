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
            'message' => "Problem: You get an undirected tree of n tasks as an edge list and an array baseTime. Using the finish-time rule from Finish Time of Tasks I, choose any task as the root and compute its finish time. Return the smallest finish time over all choices of root. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every task as root', 'next' => 's2'],
                ['label' => 'Keep root 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): edges [[0, 1], [1, 2], [1, 3]], baseTime = [2, 6, 1, 3] → 13 instead of 11.\nStep back to when you kept root 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Finish time at a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'latest + baseTime', 'next' => 'wrong_b'],
                ['label' => '2 · latest − earliest + baseTime', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): edges [[0, 1], [1, 2], [1, 3]], baseTime = [2, 6, 1, 3] → 9 instead of 11.\nStep back to when you dropped the spread.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 11, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
