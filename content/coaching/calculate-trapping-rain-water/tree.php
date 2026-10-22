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
            'message' => "Problem: A table lists bar heights by position. Report the total amount of rain water trapped between the bars, as in the classic trapping-rain-water problem. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWater above a bar?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(left max, right max) − height', 'next' => 's2'],
                ['label' => 'Overall max − height', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Heights 0, 1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1 → 22 instead of 6.\nStep back to when you used the overall max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window frames?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop one row before', 'next' => 'wrong_b'],
                ['label' => 'Include the current row', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Tall bars go negative; the same heights → 2 instead of 6.\nStep back to when you excluded the current row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The checks → 6 and 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
