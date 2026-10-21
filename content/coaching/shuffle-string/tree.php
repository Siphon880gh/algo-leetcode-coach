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
            'message' => "Read the problem statement above.\nDirection?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write s[i] to indices[i]', 'next' => 's2'],
                ['label' => 'Read s[indices[i]] into i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is the inverse permutation.\nStep back to when you gathered.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Can two characters land on one index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: handle collisions', 'next' => 'wrong_b'],
                ['label' => 'No: indices are unique', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement guarantees unique indices.\nStep back to when you handled collisions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unneeded: direct placement', 'next' => 'success'],
                ['label' => 'Sort by index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting adds log n for nothing.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"codeleet\" → \"leetcode\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
