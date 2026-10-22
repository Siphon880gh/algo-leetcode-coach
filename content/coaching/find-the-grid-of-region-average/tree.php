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
            'message' => "Read the problem statement above.\nWindow is a region when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every adjacent pair differs by ≤ threshold', 'next' => 's2'],
                ['label' => 'Max − min ≤ threshold', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → the image unchanged instead of all 9s.\nStep back to when you used max − min.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add to each cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The raw window sum, divided at the end', 'next' => 'wrong_b'],
                ['label' => 'The rounded-down average', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. image [[8, 8, 5, 2], [8, 7, 0, 6], [5, 4, 4, 7]], threshold 7 → first row [5, 5, 5, 4] instead of [5, 4, 4, 4].\nStep back to when you summed raw values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → all 9s; 25, 27, 27, 30 by row; unchanged.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
