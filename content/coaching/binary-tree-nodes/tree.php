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
            'message' => "Problem: A table lists the nodes of a binary tree, each with its parent (empty for the root). Label each node as root, inner or leaf, using the labels the statement gives. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRoot test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P IS NULL', 'next' => 's2'],
                ['label' => 'P = NULL', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. = NULL is never true; the root 5 comes out inner.\nStep back to when you used =.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leaf test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'N NOT IN (SELECT P FROM tree)', 'next' => 'wrong_b'],
                ['label' => 'Not in the parent list without NULLs', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The list holds the root’s NULL, so NOT IN is never true; every non-root node comes out inner.\nStep back to when you kept the NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → leaves 1, 3, 6, 9; inner 2, 8; root 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
