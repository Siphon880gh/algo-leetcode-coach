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
            'message' => "Read the problem statement above.\nDoes deleting one column affect another?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: columns are judged separately', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In this version each column only has to be sorted on its own.\nStep back to when you linked columns.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A column has \"b\" above \"a\". Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap them', 'next' => 'wrong_b'],
                ['label' => 'Count it as deleted', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You can only delete columns.\nStep back to when you swapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal letters stacked?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fine: the column can still be sorted', 'next' => 'success'],
                ['label' => 'Unsorted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Non-decreasing allows equal letters.\nStep back to when you rejected ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). [\"cba\",\"daf\",\"ghi\"] → 1. [\"a\",\"b\"] → 0. [\"zyx\",\"wvu\",\"tsr\"] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
