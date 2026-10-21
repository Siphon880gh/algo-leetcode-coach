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
            'message' => "Problem: Each node has left, right, and a random pointer (any node or null). Return a deep copy using the copy node class the statement specifies. For instance, if a leaf's random points to the root, the copy's leaf must point to the copied root. (Restated from memory; limits and examples may differ slightly.)\nStore the copy when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before recursing', 'next' => 's2'],
                ['label' => 'After the children', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Random links can loop back first.\nStep back to when you stored late.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Copy random how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Point to the original node', 'next' => 'wrong_b'],
                ['label' => 'Through the same map', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The copy must not reference originals.\nStep back to when you reused originals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Null random?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stays null', 'next' => 'success'],
                ['label' => 'Points to itself', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Null maps to null.\nStep back to when you self-linked.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time and space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
