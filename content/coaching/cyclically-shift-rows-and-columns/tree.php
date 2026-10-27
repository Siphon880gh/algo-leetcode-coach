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
            'message' => "Read the problem statement above.\nWhich shift happens first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Columns, then rows', 'next' => 'wrong_a'],
                ['label' => 'Rows, then the columns of the new grid', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Columns first gives [[4, 1], [3, 2]] instead of [[2, 4], [3, 1]] for Example 1.\nStep back to when you swapped the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A row of length 3, [1, 2, 3], shifts left by 1. Result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[2, 3, 1]', 'next' => 'success'],
                ['label' => '[3, 1, 2]', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 1, 2] is a right shift. A left shift moves column j to (j − 1 + n) mod n.\nStep back to when you shifted right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two passes with a scratch grid. O(n²). Examples give [[2, 4], [3, 1]] and [[7, 8, 5], [2, 3, 9], [6, 4, 1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
