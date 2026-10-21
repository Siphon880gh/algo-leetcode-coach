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
            'message' => "Problem: Design a class built from an undirected weighted graph (n nodes and an edge list) that answers queries (p, q, limit): is there a path from p to q using only edges strictly shorter than limit? Queries arrive online. For instance, with edges (0,1,2), (1,2,4), (2,0,8), query (0, 1, 2) → false and (0, 2, 5) → true. (Restated from memory; limits and examples may differ slightly.)\nWhich edges matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the minimum spanning forest', 'next' => 's2'],
                ['label' => 'Every edge', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. If any < limit path exists, the MST path also has all edges < limit.\nStep back to when you kept every edge.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Path compression?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, as usual', 'next' => 'wrong_b'],
                ['label' => 'No, it would lose the recorded union weights', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Compression rewires parents and breaks the weight on each link.\nStep back to when you compressed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Climb rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Follow a parent only while its weight < limit', 'next' => 'success'],
                ['label' => 'Always climb to the root', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Climbing past a heavy link would use a forbidden edge.\nStep back to when you climbed to the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E log E) build, O(log n) per query. Constructed check → false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
