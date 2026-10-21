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
            'message' => "Problem: Given colors with values 1, 2, or 3 and queries (i, c), return the distance from i to the nearest index of color c, or −1 if c is absent. For instance, colors [2,1,3] with queries [[0,3],[1,2],[2,1]] gives [2,1,1]. (Restated from memory; limits and examples may differ slightly.)\nSearch outward for each query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: precompute two sweeps per color', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each query could cost O(n).\nStep back to when you searched per query.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'left[c][i] only', 'next' => 'wrong_b'],
                ['label' => 'min(left[c][i], right[c][i])', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The nearest one may be on the right.\nStep back to when you used one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Color never appears. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Both distances are infinite, so return −1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). [2,1,3], [[0,3],[1,2],[2,1]] → [2,1,1]. [1,1], [[0,2]] → [−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
