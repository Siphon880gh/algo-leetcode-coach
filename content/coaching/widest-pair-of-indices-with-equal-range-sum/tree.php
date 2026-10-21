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
            'message' => "Problem: Given two binary arrays of equal length, find the widest range [i, j] (width j − i + 1) on which both arrays have the same sum; return that width, or 0 if no such range exists. For instance, [1,1,0,1] and [0,1,1,0] → 3; [0,1] and [1,1] → 1; [0] and [1] → 0. (Restated from memory; limits and examples may differ slightly.)\nEqual range sums mean?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same prefix difference Σ(a − b) at both ends', 'next' => 's2'],
                ['label' => 'Same prefix sum of a at both ends', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sums of a alone ignore b; compare the difference of the two arrays.\nStep back to when you used one array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Initial entry in the map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'Difference 0 at index −1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ranges starting at index 0 would be missed; [1] and [1] → 1 needs it.\nStep back to when you started with an empty map.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which index do you keep per difference?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first occurrence', 'next' => 'success'],
                ['label' => 'The latest occurrence', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The latest index gives the shortest range, not the widest.\nStep back to when you overwrote it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 3, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
