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
            'message' => "Read the problem statement above.\nWhat do you track?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count[x] left to place and tails[x] = subsequences ending at x', 'next' => 's2'],
                ['label' => 'Only the list of subsequences built so far', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Searching that list for one to extend is slow; tails[x − 1] answers in O(1).\nStep back to when you kept full lists.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For x with count[x] > 0, tails[x − 1] > 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start a new run at x', 'next' => 'wrong_b'],
                ['label' => 'Extend: move one tail from x − 1 to x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Extending never hurts, while a new run needs x + 1 and x + 2 to exist.\nStep back to when you started a new run.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cannot extend. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start x, x + 1, x + 2 if both are left, adding a tail at x + 2; otherwise return false', 'next' => 'success'],
                ['label' => 'Start a run of length 1 and hope it grows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every subsequence must have length at least 3, so claim the next two values now.\nStep back to when you left a short run.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Greedy with count and tails: O(n). [1,2,3,3,4,5] → true. [1,2,3,4,4,5] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
