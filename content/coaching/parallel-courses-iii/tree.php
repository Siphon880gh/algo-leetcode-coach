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
            'message' => "Read the problem statement above.\nHow many courses at once?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any number in parallel', 'next' => 's2'],
                ['label' => 'One at a time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Courses may run simultaneously, so only dependency chains matter.\nStep back to when you ran them one by one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "finish[v]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'time[v] + the sum of prerequisite finishes', 'next' => 'wrong_b'],
                ['label' => 'time[v] + the latest prerequisite finish', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Prerequisites run in parallel; Example 1 → 8, not 10.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The maximum finish over all courses', 'next' => 'success'],
                ['label' => 'The finish of course n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Course n need not be the last to finish.\nStep back to when you used course n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + E). Examples → 8, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
