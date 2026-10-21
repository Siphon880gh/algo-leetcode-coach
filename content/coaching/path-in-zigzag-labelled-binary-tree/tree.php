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
            'message' => "Read the problem statement above.\nBuild the tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: labels reach 10⁶; use arithmetic', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The path only needs the labels.\nStep back to when you built the tree.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Parent of label in row d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'label // 2', 'next' => 'wrong_b'],
                ['label' => '(lo + hi − label) // 2, with lo = 2^(d−1), hi = 2^d − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That ignores the zigzag.\nStep back to when you only halved.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of the output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Root first, so reverse the collected labels', 'next' => 'success'],
                ['label' => 'As collected', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You collected from the leaf upward.\nStep back to when you kept that order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log label). 14 → [1,3,4,14]. 26 → [1,2,6,10,26].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
