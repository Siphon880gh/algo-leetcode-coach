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
            'message' => "Read the problem statement above.\nTwo colors reach a cell at the same step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the larger', 'next' => 's2'],
                ['label' => 'Keep the first one processed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [[1, 1, 1], [1, 1, 2], [1, 2, 2]] instead of [[1, 1, 2], [1, 2, 2], [2, 2, 2]].\nStep back to when you kept the first color.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A larger color arrives a step later?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The larger color takes over', 'next' => 'wrong_b'],
                ['label' => 'The cell keeps its color', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → every cell 5 instead of [[3, 3, 3], [5, 5, 5], [5, 5, 5]].\nStep back to when you let later colors overwrite.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). Examples → [[1, 1, 2], [1, 2, 2], [2, 2, 2]], [[3, 3, 3], [5, 5, 5], [5, 5, 5]], [[5, 5], [5, 5]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
