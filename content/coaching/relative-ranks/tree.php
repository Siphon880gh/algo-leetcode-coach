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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort indexes by score, descending', 'next' => 's2'],
                ['label' => 'Sort the scores and output in sorted order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting scores loses which athlete had which score.\nStep back to when you sorted the scores alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index idx[p] has place p + 1.\nWhere does its label go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ans[p]', 'next' => 'wrong_b'],
                ['label' => 'ans[idx[p]]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Answers must be in the original order. Writing at p puts them in rank order.\nStep back to when you wrote at position p.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Label = medal for p < 3, else str(p + 1). O(n log n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort indexes, write at the original index, str(p + 1)', 'next' => 'success'],
                ['label' => 'Use str(p) for places from 4 on', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Places are 1-based. str(p) would call 4th place \"3\".\nStep back to when you used str(p).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Indexes sorted by score, labels at original positions. → [Gold, \"5\", Bronze, Silver, \"4\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
