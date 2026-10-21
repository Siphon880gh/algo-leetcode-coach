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
            'message' => "Problem: Given the root of an N-ary tree, return a deep copy. For instance, a root 1 with children 3, 2, 4 (3 having children 5, 6) must be copied with the same shape and values. (Restated from memory; limits and examples may differ slightly.)\nCopy the children list by reference?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: clone each child', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The copy would share nodes.\nStep back to when you reused the list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Child order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order', 'next' => 'wrong_b'],
                ['label' => 'Preserve it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Order is part of the structure.\nStep back to when you reordered.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Null root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return null', 'next' => 'success'],
                ['label' => 'Return an empty node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nothing to copy.\nStep back to when you created a node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Same shape and values, with no shared nodes.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
