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
            'message' => "Problem: n people and logs [timestamp, x, y], each saying x and y became friends then; acquaintance is friendship through any chain. Return the earliest timestamp when everyone is acquainted, or −1. For instance, with n = 4 and logs [[1,0,1],[2,1,2],[3,2,3]], the answer is 3; with only [[1,0,1]], it is −1. (Restated from memory; limits and examples may differ slightly.)\nAssume the logs are in time order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort them first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The input may be shuffled.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you know everyone is connected?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every person appeared in some log', 'next' => 'wrong_b'],
                ['label' => 'The group count reaches 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Appearing does not mean one connected group.\nStep back to when you checked appearances.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "x and y already share a root. Change the count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No groups merged.\nStep back to when you decremented.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L log L + L · α(n)). The two examples give 3 and −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
