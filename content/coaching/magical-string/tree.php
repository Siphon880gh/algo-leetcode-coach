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
                ['label' => 'Generate s using s itself as the list of group lengths', 'next' => 's2'],
                ['label' => 'Look for a closed-form formula for the count of 1s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Searching for a pattern or a formula has no simple closed form here. The string describes itself, so you can generate it.\nStep back to when you searched for a formula.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Seed s = [1, 2, 2] and read pointer i = 2.\nWhat do you append?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's[i] copies of the last digit', 'next' => 'wrong_b'],
                ['label' => 's[i] copies of 3 − s[-1] (the other digit), then i += 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Groups alternate between 1 and 2. Repeating the last digit merges two groups into one.\nStep back to when you repeated the last digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when len(s) >= n and count the 1s in s[:n]. The writer stays ahead of the reader since every group is at least 1 long. O(n) time and space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Seed 122, append other digit s[i] times, count in s[:n]', 'next' => 'success'],
                ['label' => 'Count the 1s in the whole generated s', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last group can push s past n. Counting all of s may include extra 1s.\nStep back to when you counted the whole string.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Generate from the seed 122 by reading group lengths from s, then count 1s in the first n. n = 6 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
