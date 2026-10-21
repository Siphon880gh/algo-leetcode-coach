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
            'message' => "Read the problem statement above.\nSort key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(start, −end)', 'next' => 's2'],
                ['label' => 'start only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With equal starts the longer one must come first.\nStep back to when you sorted by start alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Covered when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'end < previous end', 'next' => 'wrong_b'],
                ['label' => 'end ≤ maxEnd', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Compare with the running max, not just the previous one.\nStep back to when you used the previous interval.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Intervals not covered', 'next' => 'success'],
                ['label' => 'Covered intervals', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is what remains.\nStep back to when you counted the covered ones.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [[1,4],[3,6],[2,8]] → 2. [[1,4],[2,3]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
