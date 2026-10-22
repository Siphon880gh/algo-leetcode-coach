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
            'message' => "Read the problem statement above.\nWhich index groups?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k·1², k·2², … for every k', 'next' => 's2'],
                ['label' => 'Only the square indices 1, 4, 9, …', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Other groups can be better; example 1 → 13 instead of 16.\nStep back to when you used only k = 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '1, as the statement does', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The groups shift; the examples → 14 and 13 instead of 16 and 20.\nStep back to when you indexed from 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 16, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
