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
            'message' => "Read the problem statement above.\nIs WHERE referee_id != 2 enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: also keep the rows where referee_id IS NULL', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. NULL != 2 is unknown, not true, so the customers without a referee disappear.\nStep back to when you used != alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test for a missing referee?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'referee_id = NULL', 'next' => 'wrong_b'],
                ['label' => 'referee_id IS NULL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. = NULL is never true; SQL needs IS NULL.\nStep back to when you used = NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can one condition do both?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'NOT (referee_id <=> 2), or IFNULL(referee_id, 0) != 2', 'next' => 'success'],
                ['label' => 'referee_id <> 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. <> is just another spelling of !=, with the same null problem.\nStep back to when you switched to <>.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. referee_id != 2 OR referee_id IS NULL, or a null-safe test: O(n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
