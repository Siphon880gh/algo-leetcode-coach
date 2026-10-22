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
            'message' => "Problem: You are given some node of a doubly linked list (each node has next and previous pointers), not necessarily the head. Return the list’s values from head to tail. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nFirst?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk prev to the head', 'next' => 's2'],
                ['label' => 'Read next from the given node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check → [4, 2] instead of [3, 1, 4, 2].\nStep back to when you read forward only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse what you met while walking back', 'next' => 'wrong_b'],
                ['label' => 'Read next from the head to the end', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That gives [3, 1, 4] and misses 2.\nStep back to when you reversed the backward walk.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → [3, 1, 4, 2], [7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
