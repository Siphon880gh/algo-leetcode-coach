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
            'message' => "Read the problem statement above.\nThree equal digits where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Consecutive, in one window', 'next' => 's2'],
                ['label' => 'Anywhere in the string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 333 instead of an empty string.\nStep back to when you counted digits anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Best so far starts as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digit 0, meaning none', 'next' => 'wrong_b'],
                ['label' => 'Nothing found', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → an empty string instead of 000.\nStep back to when you used 0 as none.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several matches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the largest', 'next' => 'success'],
                ['label' => 'Return the first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 1112229 → 111 instead of 222.\nStep back to when you returned the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 777, 000, empty.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
