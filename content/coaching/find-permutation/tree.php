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
            'message' => "Problem: s of I (next larger) and D (next smaller), length up to 1e5. Return the lexicographically smallest permutation of 1..n + 1 that matches. \"I\" → [1,2]. \"DI\" → [2,1,3]. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start from [1, 2, …, n + 1]; it already satisfies every I', 'next' => 's2'],
                ['label' => 'Try permutations in order until one matches', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. There are (n + 1)! permutations. Searching them is impossible.\nStep back to when you searched permutations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"IDDI\": start [1,2,3,4,5]. The D run covers positions 1 and 2.\nWhich block do you reverse?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only indexes 1 and 2', 'next' => 'wrong_b'],
                ['label' => 'Indexes 1 to 3: the run plus the element after it → [1,4,3,2,5]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two D's need three decreasing values. Reversing only two positions leaves the last D broken.\nStep back to when you reversed just the D positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stack version: push 1..n + 1; at each I or at the end, pop everything to the output. O(n). DI String Match (942) accepts any valid answer.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ascending base, reverse each D run plus one. Not 942', 'next' => 'success'],
                ['label' => 'Start from [n + 1, …, 1] and fix the I positions', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Big numbers first are valid but not the smallest. \"I\" would give [2, 3]-style answers that start larger than needed.\nStep back to when you started from the largest values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Ascending base, flip every D run together with the element after it. \"IDDI\" → [1,4,3,2,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
