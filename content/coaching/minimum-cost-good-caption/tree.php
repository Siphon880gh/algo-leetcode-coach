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
            'message' => "Read the problem statement above.\nChange letter when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only after a run of 3', 'next' => 's2'],
                ['label' => 'Any time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. aca stays aca, which is not a good caption.\nStep back to when you switched freely.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie between letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The larger letter', 'next' => 'wrong_b'],
                ['label' => 'The smaller letter', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → dddd instead of cccc.\nStep back to when you took the larger.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n). Examples → cccc, aaa, empty.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
