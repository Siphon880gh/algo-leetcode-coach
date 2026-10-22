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
            'message' => "Read the problem statement above.\nFirst task’s duration?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its leave time', 'next' => 's2'],
                ['label' => 'Skip it, since it has no previous task', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It starts at time 0; Example 3 → 1 instead of 0.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal durations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the earlier task', 'next' => 'wrong_b'],
                ['label' => 'Keep the smaller id', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. logs = [[1,10],[0,20]] → 1 instead of 0.\nStep back to when you kept the first one found.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len(logs)). Examples → 1, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
