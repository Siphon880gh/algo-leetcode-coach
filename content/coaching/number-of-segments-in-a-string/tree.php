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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each position where a segment starts', 'next' => 's2'],
                ['label' => 'Count the spaces and add one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counting spaces plus one breaks on leading, trailing, or repeated spaces. \"  a  \" has 4 spaces and 1 segment.\nStep back to when you counted spaces.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walk i from 0.\nWhen does i start a segment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's[i] is not a space', 'next' => 'wrong_b'],
                ['label' => 's[i] is not a space and (i == 0 or s[i − 1] is a space)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Counting every non-space character counts letters, not segments. \"Hello\" would be 5.\nStep back to when you counted all non-space characters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One pass, O(n) time, O(1) space. split() with empty pieces dropped gives the same count with extra memory. Length of Last Word (58) measures one run instead.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count segment starts. Only space separates. Not 58 / 151', 'next' => 'success'],
                ['label' => 'Also split on commas and periods', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Punctuation is not a separator here. \"Hello,\" is one segment.\nStep back to when you split on punctuation.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count every segment start: a non-space at index 0 or after a space. \"Hello, my name is John\" → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
