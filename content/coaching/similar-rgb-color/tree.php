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
            'message' => "Problem: Problem: Given a color \"#RRGGBB\", return the most similar color that has a shorthand form \"#XYZ\" (meaning \"#XXYYZZ\"), where similarity is the negative sum of squared channel differences. (Restated from memory; limits and examples may differ slightly.)\nMust you try all shorthand colors together?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the score is a sum over channels, so choose each separately', 'next' => 's2'],
                ['label' => 'Yes, all 4096', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That works, but the channels do not interact.\nStep back to when you combined them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which values can a shorthand channel take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any value', 'next' => 'wrong_b'],
                ['label' => 'Multiples of 17: 0x00, 0x11, …, 0xFF', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A shorthand channel repeats one hex digit, which is 17 times that digit.\nStep back to when you allowed any value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you pick the closest digit q?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(v + 8) // 17', 'next' => 'success'],
                ['label' => 'v // 17', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That always rounds down.\nStep back to when you floored.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). \"#09f166\" → \"#11ee66\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
