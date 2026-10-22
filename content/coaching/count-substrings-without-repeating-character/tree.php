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
            'message' => "Problem: Given a string of lowercase letters, count its substrings in which no letter appears more than once. The exact limits are in the official statement. For instance, abcd → 10, aa → 2 and abca → 9. (Restated from memory; limits and examples may differ slightly.)\nA letter repeats inside the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move l just past its earlier copy', 'next' => 's2'],
                ['label' => 'Reset l to r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That drops valid starts; abca → 7 instead of 9.\nStep back to when you reset to r.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For each right end, add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => 'r − l + 1, one per start', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every start in the window counts; abcd → 4 instead of 10.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The examples → 10, 2, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
