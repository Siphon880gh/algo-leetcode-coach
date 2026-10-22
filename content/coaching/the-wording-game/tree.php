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
            'message' => "Problem: Alice and Bob each hold a sorted list of distinct words and take turns playing words, Alice first. Each word played must be related to the previous one by the rules in the official statement, and a player who cannot play loses. Return whether Alice wins when both play optimally. The exact rules and limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nDecide a play by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whether the opponent has a winning reply', 'next' => 's2'],
                ['label' => 'Play the largest valid word', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Under the guide’s assumed rules, Alice [aaa, cbb] vs Bob [abb, ba]: this rule says Alice wins, but a full game search says she loses.\nStep back to when you played the largest word.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A shortcut instead of the table?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always play the smallest valid word', 'next' => 'wrong_b'],
                ['label' => 'No: fill it from the largest word down', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Alice [a, aa, b] vs Bob [ab, b]: this rule says Alice wins, but a full game search says she loses.\nStep back to when you played the smallest word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log(n + m)) under the assumed rules.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
