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
            'message' => "Problem: n houses stand on a circle. Each pair of neighbours is joined by a road whose length depends on the direction you walk it: forward[i] for the step from house i to the next house, and backward[i] for the step from house i to the previous house (this guide assumes that indexing). Starting at house 0, visit the houses in queries in order and return the minimum total distance walked. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nDirection?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cheaper of clockwise and counter-clockwise', 'next' => 's2'],
                ['label' => 'Always clockwise', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. forward = [2, 2, 2], backward = [1, 1, 1], queries = [2, 1] → 8 instead of 2.\nStep back to when you only went clockwise.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Counter-clockwise cost uses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The forward roads in reverse', 'next' => 'wrong_b'],
                ['label' => 'The backward roads', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same check → 4 instead of 2.\nStep back to when you reused forward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Checks → 2, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
