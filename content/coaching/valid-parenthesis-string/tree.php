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
            'message' => "Read the problem statement above.\nBranch three ways on every star?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: track the range [lo, hi] of possible open counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 3^stars branches.\nStep back to when you branched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "hi < 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clamp hi to 0', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Even with every star as an open paren, there are too many closers.\nStep back to when you clamped hi.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "lo < 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clamp lo to 0 and continue', 'next' => 'success'],
                ['label' => 'Return false', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. lo < 0 only means some star choices failed; others may still work.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Greedy range, accepting when lo == 0 at the end: O(n). \"(*)\" → true. \"(*))\" → true. \")(\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
