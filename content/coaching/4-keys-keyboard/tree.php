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
            'message' => "Problem: Problem: A special keyboard has four keys: print one A, select all, copy, and paste. With n key presses, return the largest number of A's you can have on the screen. (Restated from memory; limits and examples may differ slightly.)\nIs greedy enough, such as always pasting once you have copied?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use dp[i], the best with i presses', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. When to copy again depends on how many presses remain.\nStep back to when you chose greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What are the options for the last block of presses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only press A or paste once', 'next' => 'wrong_b'],
                ['label' => 'Press A (dp[i − 1] + 1), or at dp[j] do select, copy, and i − j − 2 pastes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A select-copy-paste run multiplies an earlier best, which is where the growth comes from.\nStep back to when you dropped the run.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What does the run starting at dp[j] give?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[j] · (i − j − 1)', 'next' => 'success'],
                ['label' => 'dp[j] · (i − j)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Select and copy cost 2 presses; i − j − 2 pastes plus the original copy gives the factor i − j − 1.\nStep back to when you counted the factor.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. dp[i] = max(dp[i − 1] + 1, max over j of dp[j] · (i − j − 1)): O(n²). n = 3 → 3. n = 7 → 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
