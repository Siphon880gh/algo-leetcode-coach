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
            'message' => "Problem: A tree rooted at node 0 is given by its edges, and every node has a color. Return the size of the largest subtree whose nodes all have the same color. Limits are in the official statement. For instance, edges [[0, 1], [0, 2], [2, 3], [2, 4]] with colors [1, 2, 2, 2, 2] → 3. (Restated from memory; limits and examples may differ slightly.)\nSubtree of u is uniform when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each child subtree is uniform and matches u', 'next' => 's2'],
                ['label' => 'Each child matches u', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Deeper nodes count too; the chain 0 – 1 – 2 with colors [1, 1, 2] → 3 instead of 1.\nStep back to when you checked only children.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count of the most common color', 'next' => 'wrong_b'],
                ['label' => 'Largest uniform subtree', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The example → 4 instead of 3.\nStep back to when you counted colors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
