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
            'message' => "Read the problem statement above.\nMatch feedback words how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whole words after splitting', 'next' => 's2'],
                ['label' => 'Substring search in the report', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. smartest is not smart; reports [smartest one, a smart one] for ids [1,2], k = 1 → [1] instead of [2].\nStep back to when you searched substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the input order', 'next' => 'wrong_b'],
                ['label' => 'The smaller id first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two reports with no feedback words for ids [2,1], k = 1 → [2] instead of [1].\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total words + n log n). Examples → [1,2], [2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
