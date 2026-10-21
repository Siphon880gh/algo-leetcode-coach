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
            'message' => "Read the problem statement above.\nRemove \"aa\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: same case stays', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only opposite cases cancel.\nStep back to when you removed aa.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeated passes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop until stable', 'next' => 'wrong_b'],
                ['label' => 'One stack pass suffices', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The stack handles chains like abBA.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Case test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't ≠ c and lower(t) == lower(c)', 'next' => 'success'],
                ['label' => '|t − c| == 26', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Upper and lower ASCII differ by 32.\nStep back to when you used 26.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"leEeetcode\" → \"leetcode\". \"abBAcC\" → \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
