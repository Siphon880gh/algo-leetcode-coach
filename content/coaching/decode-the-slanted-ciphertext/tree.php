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
            'message' => "Read the problem statement above.\nGrid width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'len(encodedText) / rows', 'next' => 's2'],
                ['label' => 'rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The text was laid out row by row, so each row holds len / rows characters.\nStep back to when you used rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Read the grid how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Column by column, top to bottom', 'next' => 'wrong_b'],
                ['label' => 'Each diagonal down-right, starting from row 0 column j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 read by columns does not give cipher; the original was written along diagonals.\nStep back to when you read columns.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which spaces to remove?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only trailing spaces', 'next' => 'success'],
                ['label' => 'All spaces', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 → i love leetcode keeps its inner spaces.\nStep back to when you removed all of them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len). Examples → cipher, i love leetcode, coding.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
