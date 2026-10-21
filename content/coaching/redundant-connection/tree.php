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
            'message' => "Read the problem statement above.\nHow do you detect the extra edge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union-find over the edges in input order', 'next' => 's2'],
                ['label' => 'Count node degrees', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A degree of 3 is normal in a tree; degrees do not reveal the cycle.\nStep back to when you counted degrees.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "find(u) == find(v). Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union them anyway and continue', 'next' => 'wrong_b'],
                ['label' => 'Return this edge: it closes the cycle', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. This edge is the one that makes the cycle.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is the first failing edge the last cycle edge in the input?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: the other cycle edges were merged before it', 'next' => 'success'],
                ['label' => 'No: you must collect the cycle and pick the last', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Union-find in input order fails exactly on the latest cycle edge.\nStep back to when you collected the cycle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Union-find with path compression: O(n α(n)). [[1,2],[1,3],[2,3]] → [2,3]. [[1,2],[2,3],[3,4],[1,4],[1,5]] → [1,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
