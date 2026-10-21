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
            'message' => "Read the problem statement above.\nWhich palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first one in the array', 'next' => 's2'],
                ['label' => 'The longest one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 → ada, although racecar is longer.\nStep back to when you took the longest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Palindrome test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First and last characters match', 'next' => 'wrong_b'],
                ['label' => 'Every character matches its mirror', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abca has equal ends but is not a palindrome.\nStep back to when you checked only the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the empty string', 'next' => 'success'],
                ['label' => 'Return the first word', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 3 → empty string.\nStep back to when you returned a word.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → ada, racecar, empty string.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
