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
            'message' => "Read the problem statement above.\nWinners who never lost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record them with 0 losses', 'next' => 's2'],
                ['label' => 'Only track losers', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 would miss 1, 2 and 10 in answer[0].\nStep back to when you only tracked losers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "answer[1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one loss', 'next' => 'wrong_b'],
                ['label' => 'Exactly one loss', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Players with 0 losses would appear in both lists.\nStep back to when you used at most one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which players?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those in some match', 'next' => 'success'],
                ['label' => 'Every id from 1 to the max', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[1,3]] → [[1],[3]]; 2 never played.\nStep back to when you scanned every id.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m). Examples → [[1,2,10],[4,5,7,8]], [[1,2,5,6],[]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
