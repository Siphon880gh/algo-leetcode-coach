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
            'message' => "Read the problem statement above.\nAssume the sides are axis-aligned?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: rectangles may be rotated', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is problem 939.\nStep back to when you assumed axis-aligned sides.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test for a right angle at p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The slopes multiply to −1', 'next' => 'wrong_b'],
                ['label' => 'The dot product (a − p) · (b − p) is 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Slopes break on vertical sides and need division.\nStep back to when you used slopes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where is the fourth corner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a + b − p', 'next' => 'success'],
                ['label' => 'a + b', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The opposite corner is p shifted by both side vectors.\nStep back to when you dropped −p.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). [[1,2],[2,1],[1,0],[0,1]] → 2.00000. [[0,1],[2,1],[1,1],[1,0],[2,0]] → 1.00000. [[0,3],[1,2],[3,1],[1,3],[2,1]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
