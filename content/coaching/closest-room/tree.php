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
            'message' => "Read the problem statement above.\nQuery order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By minSize descending, offline', 'next' => 's2'],
                ['label' => 'Input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Online order forces deletions or rescans.\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Candidates after bisecting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the next larger id', 'next' => 'wrong_b'],
                ['label' => 'The ids on both sides of the insertion point', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A smaller id can be closer.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the smaller id', 'next' => 'success'],
                ['label' => 'Take the larger id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties go to the smaller room id.\nStep back to when you took the larger.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [3,-1,3], [2,1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
