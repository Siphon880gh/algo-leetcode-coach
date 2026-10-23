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
            'message' => "Problem: You get a tree rooted at node 0 as a parent array. Every node has some red, blue, and white gates. A person holding a red or blue card moves from a node to its parent by using one gate at that node: a gate of the card's colour keeps the card, and a white gate flips it. Each query gives Alice's start node and card and Bob's start node and card; both climb to their lowest common ancestor. Count the ways for each query (Alice's ways times Bob's, modulo 10^9 + 7, where every gate is distinct) and return the XOR of all the counts. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhite gate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flips the card', 'next' => 's2'],
                ['label' => 'Keeps the card', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): parent = [−1, 0, 1, 2], gates = [[0, 0, 0], [1, 0, 2], [0, 2, 1], [3, 1, 0]], queries = [[3, 1, 0, 0], [3, 0, 1, 1]] → 10 instead of 5.\nStep back to when you kept the card.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine Alice and Bob?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add their ways', 'next' => 'wrong_b'],
                ['label' => 'Multiply their ways', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same check → 3 instead of 5.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Constructed checks → 5, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
