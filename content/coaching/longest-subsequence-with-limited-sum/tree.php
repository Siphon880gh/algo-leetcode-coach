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
            'message' => "Read the problem statement above.\nWhich values to take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest ones, so sort nums', 'next' => 's2'],
                ['label' => 'A prefix of nums as given', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Order does not matter for a sum; Example 1 → [0,2,4] instead of [2,3,4].\nStep back to when you kept the original order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count prefix sums that are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '< q (lower bound)', 'next' => 'wrong_b'],
                ['label' => '≤ q (upper bound)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A sum equal to q is allowed; nums = [1,2], queries = [3] → [1] instead of [2].\nStep back to when you used lower bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort the queries too?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only together with their indices, or not at all', 'next' => 'success'],
                ['label' => 'Yes, and output in that order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. queries = [21,3] on Example 1’s nums → [2,4] instead of [4,2].\nStep back to when you lost the query order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log n). Examples → [2,3,4], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
