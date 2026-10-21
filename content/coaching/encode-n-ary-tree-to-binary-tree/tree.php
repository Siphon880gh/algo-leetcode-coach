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
            'message' => "Problem: N-ary tree with 0 to 1e4 nodes. Write encode (N-ary → binary tree) and decode (binary → N-ary) so every tree round-trips. No state on the codec. Empty ↔ empty. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'left = first child, right = next sibling', 'next' => 's2'],
                ['label' => 'Put child 0 in left and child 1 in right; drop the rest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each binary node has only two slots. A node with three children cannot fit them in left and right directly.\nStep back to when you put children straight into left and right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Encode node 1 with children 3, 2, 4: left = enc(3), enc(3).right = enc(2), enc(2).right = enc(4).\nHow does decode recover the children of 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk the left spine; each node on it is one child', 'next' => 'wrong_b'],
                ['label' => 'Go to left once, then follow right pointers; each node on that chain is one child', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In this encoding, left is the first child, so a long left chain is first child of first child. Walking it mixes generations.\nStep back to when you walked the left spine.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each N-ary node becomes exactly one binary node, so both directions are O(n). Serialize and Deserialize N-ary Tree (428) writes a string instead.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First child on left, siblings chained on right, in order. Not 428 / 297', 'next' => 'success'],
                ['label' => 'Prepend each sibling to the right chain so the newest is first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Siblings must keep their order. Inserting each new sibling at the front of the right chain reverses them.\nStep back to when you prepended siblings.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. First child on left, siblings in order on the right chain, decode by left then right. Round trip is exact.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
