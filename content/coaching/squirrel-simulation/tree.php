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
            'message' => "Problem: A grid has one tree, one squirrel and some nuts. The squirrel moves one cell per step, carries one nut at a time, and must bring every nut to the tree. Return the fewest steps. Tree [2,2], squirrel [4,4], nuts [[3,0],[2,5]] → 12. (Restated from memory; limits and examples may differ slightly.)\nAfter the first nut, what does each nut cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 × distance(nut, tree): a round trip from the tree', 'next' => 's2'],
                ['label' => 'distance(squirrel, nut) + distance(nut, tree) for every nut', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. After the first delivery the squirrel is standing at the tree, not at its start.\nStep back to when you started every trip from the squirrel.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What changes for the first nut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing: every nut costs the same', 'next' => 'wrong_b'],
                ['label' => 'Its outward leg starts at the squirrel: saving d(nut, tree) − d(squirrel, nut)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The squirrel does not start at the tree, so the first trip is different.\nStep back to when you treated every nut the same.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which nut goes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one with the largest saving, even if it is negative', 'next' => 'success'],
                ['label' => 'The nut closest to the squirrel', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The closest nut can be far from the tree; you want the biggest saving, which balances both distances.\nStep back to when you picked the closest nut.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Σ 2 · d(nut, tree) − the best saving: O(n) time. → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
