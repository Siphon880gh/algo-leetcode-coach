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
            'message' => "Read the problem statement above.\nCombine the lists how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add weights of equal values', 'next' => 's2'],
                ['label' => 'Concatenate and sort', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [[1,1],[1,5],[3,1],[3,8],[4,5]] instead of [[1,6],[3,9],[4,5]].\nStep back to when you concatenated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First appearance', 'next' => 'wrong_b'],
                ['label' => 'Ascending by value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → values 1, 4, 3 instead of 1, 3, 4.\nStep back to when you kept insertion order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Value in only one list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it', 'next' => 'success'],
                ['label' => 'Drop it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 loses [4,5].\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log(n + m)). Examples → [[1,6],[3,9],[4,5]], [[1,4],[2,4],[3,4]], [[1,7],[2,4],[7,1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
