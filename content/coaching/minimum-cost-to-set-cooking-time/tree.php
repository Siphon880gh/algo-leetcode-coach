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
            'message' => "Read the problem statement above.\nWhich settings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both (t/60, t mod 60) and (t/60 − 1, t mod 60 + 60)', 'next' => 's2'],
                ['label' => 'Only (t/60, t mod 60)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2: 116 costs 8, but 76 seconds typed as 76 costs 6.\nStep back to when you kept one form.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leading zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always push four digits', 'next' => 'wrong_b'],
                ['label' => 'Do not push them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 as 0076 costs 10, not 6.\nStep back to when you pushed all four digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Minutes = 100?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Invalid: borrow to 99 and seconds + 60', 'next' => 'success'],
                ['label' => 'Push 10000', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. At most four digits can be pushed; t = 6000 must be 99:60.\nStep back to when you allowed 100 minutes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 6, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
