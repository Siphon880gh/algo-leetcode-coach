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
            'message' => "Problem: You are given an m × n grid of positive heights. A person at (r, c) can see a person to the right in the same row, or below in the same column, when everyone strictly between them is shorter than both of them. Return an m × n array with the number of people each person can see. For instance, [[3,1,4,2,5]] → [[2,1,2,1,0]]; [[5,1],[3,1],[4,1]] → [[3,1],[2,1],[1,0]]. (Restated from memory; limits and examples may differ slightly.)\nAfter popping shorter people, someone taller or equal remains?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count that one too', 'next' => 's2'],
                ['label' => 'Count only the popped ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The blocker itself is visible; [[3,1,4,2,5]] → [[1,0,1,0,0]] instead of [[2,1,2,1,0]].\nStep back to when you skipped the blocker.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An equal height on top after counting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it', 'next' => 'wrong_b'],
                ['label' => 'Pop it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It hides everyone behind it from people of its height; [[3,1,1]] → [[2,1,0]] instead of [[1,1,0]].\nStep back to when you kept equal heights.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Directions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rows and columns', 'next' => 'success'],
                ['label' => 'Rows only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. People also look down; [[5,1],[3,1],[4,1]] → [[1,0],[1,0],[1,0]] instead of [[3,1],[2,1],[1,0]].\nStep back to when you scanned only rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Constructed cases → [[2,1,2,1,0]], [[3,1],[2,1],[1,0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
