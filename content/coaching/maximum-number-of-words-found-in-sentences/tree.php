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
            'message' => "Read the problem statement above.\nWords in a sentence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Spaces + 1', 'next' => 's2'],
                ['label' => 'Number of spaces', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. alice and bob love leetcode has 4 spaces and 5 words.\nStep back to when you counted spaces only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A sentence with no spaces?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Zero words', 'next' => 'wrong_b'],
                ['label' => 'One word', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sentences are non-empty, so a sentence with no spaces is a single word.\nStep back to when you counted zero.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The maximum over sentences', 'next' => 'success'],
                ['label' => 'The total over sentences', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 6, the largest single sentence.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → 6, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
