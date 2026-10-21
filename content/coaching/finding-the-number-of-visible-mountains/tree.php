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
            'message' => "Problem: You are given peaks, where peaks[i] = [x, y] describes a mountain shaped as a right-angled isosceles triangle with its base on the x-axis and its peak at (x, y), so its sides have slopes 1 and −1. A mountain is visible if its peak does not lie within another mountain, border included. Return the number of visible mountains. For instance, [[2,2],[6,3],[5,4]] → 2; [[1,3],[1,3]] → 0. (Restated from memory; limits and examples may differ slightly.)\nA peak is hidden when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its interval [x − y, x + y] lies inside another’s', 'next' => 's2'],
                ['label' => 'Another mountain is taller', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1,1],[10,2]] are far apart and both visible → 1 instead of 2.\nStep back to when you compared heights.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left ascending, right ascending', 'next' => 'wrong_b'],
                ['label' => 'Left ascending, right descending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A mountain sharing a left end with a wider one is counted; [[2,2],[3,3]] → 2 instead of 1.\nStep back to when you sorted right ends ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Identical mountains?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count none of them', 'next' => 'success'],
                ['label' => 'Count one of them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each peak lies on the other, border included; [[1,3],[1,3]] → 1 instead of 0.\nStep back to when you kept one copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
