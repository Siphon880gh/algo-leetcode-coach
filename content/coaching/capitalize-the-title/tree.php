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
            'message' => "Read the problem statement above.\nWords of 1 or 2 letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All lowercase', 'next' => 's2'],
                ['label' => 'Capitalize them like the rest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 2 keeps of in lowercase.\nStep back to when you capitalized them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letters after the first in a longer word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them as they are', 'next' => 'wrong_b'],
                ['label' => 'Lowercase', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. leTTeR must become Letter.\nStep back to when you left them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The first word of the title?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same rule as the others', 'next' => 'success'],
                ['label' => 'Always capitalized', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 3 starts with a lowercase i.\nStep back to when you special-cased it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → Capitalize The Title, First Letter of Each Word, i Love Leetcode.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
