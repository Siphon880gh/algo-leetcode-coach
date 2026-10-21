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
            'message' => "Problem: A directed graph has n nodes and edges (self-loops and repeated edges can occur). Return true if every path from source ends at destination: some path exists, every reachable node with no outgoing edge is destination, and no path can go on forever. n = 3, edges = [[0,1],[0,2]], 0 → 2 gives false. n = 4, edges = [[0,1],[0,3],[1,2],[2,1]], 0 → 3 gives false. n = 4, edges = [[0,1],[0,2],[1,3],[2,3]], 0 → 3 gives true. (Restated from memory; limits and examples may differ slightly.)\nA plain visited set is enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: you must tell a cycle from paths that merge', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two paths reaching one node is fine; a cycle is not.\nStep back to when you used a visited set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You reach a node with no outgoing edges. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always succeed', 'next' => 'wrong_b'],
                ['label' => 'Succeed only if it is destination', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A path ending elsewhere breaks the rule.\nStep back to when you always succeeded.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You reach a node that is on the current path. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 'success'],
                ['label' => 'Skip it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That cycle gives infinitely many paths.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + e). The three examples give false, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
