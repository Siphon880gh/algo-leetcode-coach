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
            'message' => "Read the problem statement above.\nLoop over jewels for each stone?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: put the jewels in a set', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(|J| · |S|).\nStep back to when you looped over jewels.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is \"a\" the same type as \"A\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: letters are case-sensitive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The problem treats them as different stones.\nStep back to when you ignored case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stones whose type is a jewel, duplicates included', 'next' => 'success'],
                ['label' => 'Distinct jewel types found', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every stone counts, even repeats.\nStep back to when you counted distinct types.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|J| + |S|). jewels \"aA\", stones \"aAAbbbb\" → 3. jewels \"z\", stones \"ZZ\" → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
