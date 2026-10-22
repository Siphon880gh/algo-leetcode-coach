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
            'message' => "Problem: You are given a starting string and a target string. In one operation you may add or remove one character at either end of the starting string. Return the fewest operations that turn it into the target. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhat survives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A common substring', 'next' => 's2'],
                ['label' => 'A common subsequence', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Kept characters stay contiguous: in the guide’s check, abcb → acb gives 1 instead of 3.\nStep back to when you used a subsequence.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost with L kept?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|s| − L', 'next' => 'wrong_b'],
                ['label' => '|s| + |t| − 2L', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Additions cost too: abcde → cdef gives 2 instead of 3.\nStep back to when you counted removals only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| · |t|). The guide’s checks match.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
