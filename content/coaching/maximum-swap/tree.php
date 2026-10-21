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
            'message' => "Read the problem statement above.\nTry every pair of swaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: record each digit\'s last index and make one greedy pass', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(d²); one pass with a last-index table is enough.\nStep back to when you tried all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which position do you improve?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The position of the smallest digit', 'next' => 'wrong_b'],
                ['label' => 'The leftmost i that has a larger digit somewhere after it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Raising the leftmost possible digit gains the most.\nStep back to when you chose the smallest digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which copy of that larger digit do you swap in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest such digit, at its last occurrence', 'next' => 'success'],
                ['label' => 'Its first occurrence', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 1993 → 9913 with the last 9, but 9193 with the first.\nStep back to when you used the first copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One swap, chosen with a last-index table: O(d). 2736 → 7236. 9973 → 9973.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
