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
            'message' => "Problem: A line chart joins the points (1, y[1]), (2, y[2]), …, (n, y[n]) with straight segments, in order. Return the largest number of points where one horizontal line meets the chart. Limits are in the official statement. For instance, y = [1, 2, 1, 2, 1, 3, 2] → 5 and y = [2, 1, 3, 4, 5] → 2. (Restated from memory; limits and examples may differ slightly.)\nA vertex shared by two segments?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it once', 'next' => 's2'],
                ['label' => 'Count it for both', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first example → 6 instead of 5.\nStep back to when you counted it twice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heights to test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Integer heights only', 'next' => 'wrong_b'],
                ['label' => 'Doubled values, so halfway heights exist', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The best line can sit between integers; the first example → 4 instead of 5.\nStep back to when you used integers only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The examples → 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
