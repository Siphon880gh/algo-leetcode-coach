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
            'message' => "Problem: A rope binary tree represents a string. Each leaf holds a non-empty string; each internal node has one or two children and stores the total length of the string it represents, which is its left child’s string followed by its right child’s string. Given the root and k, return the k-th character of the whole string. The node fields and indexing are in the official statement; the examples here count from 1. For instance, if the left subtree spells ab, cd and the right subtree spells xyz, the string is abcdxyz and k = 5 → x. (Restated from memory; limits and examples may differ slightly.)\nk is past the left part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go right with k minus the left length', 'next' => 's2'],
                ['label' => 'Go right with the same k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The right part starts after the left one; abcdxyz with k = 5 → past the end of xyz instead of x.\nStep back to when you kept k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a leaf?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return its first character', 'next' => 'wrong_b'],
                ['label' => 'Return its k-th character', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. k may point further in; abcdxyz with k = 6 → x instead of y.\nStep back to when you took the first character.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(height). Constructed checks (simulated in code) → x for k = 5, y for k = 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
