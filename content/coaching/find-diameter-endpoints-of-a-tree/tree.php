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
            'message' => "Problem: You get an undirected tree with n nodes. A diameter is a longest simple path, and a tree can have several. Return a binary string where position i is 1 when node i is an endpoint of at least one diameter, and 0 otherwise. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich nodes are endpoints?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those at distance D from a or from b', 'next' => 's2'],
                ['label' => 'Only a and b', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): edges 0–1, 0–2, 0–3, 3–4, 3–5 → \"010010\" instead of \"011011\".\nStep back to when you marked two nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Need both distances to be D?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, either one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): the same tree → \"000000\" instead of \"011011\".\nStep back to when you required both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → \"1011\", \"10001\", \"011011\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
