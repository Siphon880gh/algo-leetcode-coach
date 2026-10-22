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
            'message' => "Read the problem statement above.\nPath counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[a] + cnt[b] − 2·cnt[lca]', 'next' => 's2'],
                ['label' => 'cnt[a] + cnt[b]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Edges above the LCA are counted; example 2 → [3, 2, 4, 3] instead of [1, 2, 2, 3].\nStep back to when you skipped the LCA.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct weights − 1', 'next' => 'wrong_b'],
                ['label' => 'Path length − most common count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It ignores how many edges have each weight; example 1 → [0, 0, 1, 1] instead of [0, 0, 1, 3].\nStep back to when you counted distinct weights.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m)(26 + log n)). Examples → [0, 0, 1, 3], [1, 2, 2, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
