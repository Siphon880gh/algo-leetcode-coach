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
            'message' => "Read the problem statement above.\nWhere do the −1 marks go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(r1, c2 + 1) and (r2 + 1, c1)', 'next' => 's2'],
                ['label' => '(r1, c2) and (r2, c1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The last row and column must stay inside; Example 2 → [[1,0],[0,0]] instead of [[1,1],[1,1]].\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the marks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums along rows only', 'next' => 'wrong_b'],
                ['label' => 'Prefix sums along rows, then columns', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Row sums alone leave column effects; Example 1 → [[1,1,0],[0,1,1],[−1,−1,0]].\nStep back to when you stopped after rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q + n²). Examples → [[1,1,0],[1,2,1],[0,1,1]], [[1,1],[1,1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
