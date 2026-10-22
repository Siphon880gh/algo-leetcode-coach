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
            'message' => "Read the problem statement above.\nDuring the first search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Erase each visited cell', 'next' => 's2'],
                ['label' => 'Leave the grid unchanged', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The second search finds the same path; Example 1 → false instead of true.\nStep back to when you kept the cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many searches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One', 'next' => 'wrong_b'],
                ['label' => 'Two', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One search only shows a path exists; Example 1 → false instead of true.\nStep back to when you stopped after one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
