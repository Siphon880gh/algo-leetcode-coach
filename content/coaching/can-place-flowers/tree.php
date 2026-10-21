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
            'message' => "Read the problem statement above.\nWhere do you plant?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greedily, at each plot whose neighbors are empty', 'next' => 's2'],
                ['label' => 'Count the empty plots and divide by 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Edge runs and middle runs hold different numbers: [0,0,1] fits one, and [1,0,0,0,1] also fits only one.\nStep back to when you divided the count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You plant at i. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave the array unchanged', 'next' => 'wrong_b'],
                ['label' => 'Set bed[i] = 1 so plot i + 1 is blocked', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without the mark, plot i + 1 also looks free and you plant two flowers side by side.\nStep back to when you skipped the mark.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What about the first and last plots?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A missing neighbor counts as empty', 'next' => 'success'],
                ['label' => 'Never plant at the ends', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In [0,0,1] the only valid spot is index 0.\nStep back to when you skipped the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Greedy planting with marks and empty edges: O(n) time, O(1) space. [1,0,0,0,1], n = 1 → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
