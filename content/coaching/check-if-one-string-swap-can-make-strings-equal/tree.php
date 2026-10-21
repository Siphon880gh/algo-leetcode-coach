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
            'message' => "Read the problem statement above.\nExactly one difference?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false', 'next' => 's2'],
                ['label' => 'true', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One swap changes two positions.\nStep back to when you accepted one difference.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two differences?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always true', 'next' => 'wrong_b'],
                ['label' => 'Check s1[i] = s2[j] and s1[j] = s2[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abc vs acd differ twice but no swap fixes them.\nStep back to when you accepted any pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal strings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true (swap an index with itself)', 'next' => 'success'],
                ['label' => 'false', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero swaps are allowed.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
