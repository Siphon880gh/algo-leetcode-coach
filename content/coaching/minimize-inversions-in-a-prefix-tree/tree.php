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
            'message' => "Read the problem statement above.\nWhere does a marked node's index land relative to its own subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before all of it, so its cost is fixed', 'next' => 's2'],
                ['label' => 'Wherever the child order puts it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Pre-order records a node before visiting any child, so no ordering can move it.\nStep back to when you let it move.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Can you order children by their smallest target position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, try orders with a bitmask DP over at most 10 children', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. For [\"ab\", \"aa\", \"a\", \"b\"] with target [0, 3, 1, 2] that gives 4 instead of 3.\nStep back to when you sorted by the smallest position.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Pairwise cross costs plus a bitmask DP per node. Examples give 2 and 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
