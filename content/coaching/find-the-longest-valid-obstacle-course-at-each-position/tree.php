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
            'message' => "Read the problem statement above.\nBisect variant?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bisect_right', 'next' => 's2'],
                ['label' => 'bisect_left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal heights may extend a course.\nStep back to when you used bisect_left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does tails[i] hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An actual course', 'next' => 'wrong_b'],
                ['label' => 'Smallest last height of a course of length i + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Tails is not a real subsequence.\nStep back to when you treated it as one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer at index j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insertion position + 1', 'next' => 'success'],
                ['label' => 'len(tails)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The obstacle must end the course.\nStep back to when you used the global length.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [1,2,3,3], [1,2,1], [1,1,2,3,2,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
