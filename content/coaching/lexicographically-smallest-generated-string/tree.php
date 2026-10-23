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
            'message' => "Read the problem statement above.\nTwo T windows disagree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return ""', 'next' => 's2'],
                ['label' => 'Let the later one overwrite', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → a string starting aba, which breaks the first T, instead of \"\".\nStep back to when you overwrote.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "F window equals str2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Change its leftmost free letter', 'next' => 'wrong_b'],
                ['label' => 'Change its rightmost free letter to b', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. str1 = F, str2 = aa → ba instead of ab.\nStep back to when you changed the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). Examples → ababa, \"\", a.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
