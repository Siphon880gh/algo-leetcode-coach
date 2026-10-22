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
            'message' => "Read the problem statement above.\nReturn the distance when node2 is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Popped', 'next' => 's2'],
                ['label' => 'First pushed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A cheaper route may arrive later; Example 1’s first query → 8 instead of 6.\nStep back to when you returned on push.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Store an edge as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both directions', 'next' => 'wrong_b'],
                ['label' => 'One direction only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Edges are directed; Example 1’s second query → 3 instead of −1.\nStep back to when you added the reverse edge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log n) per query. Example → [null,6,−1,null,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
