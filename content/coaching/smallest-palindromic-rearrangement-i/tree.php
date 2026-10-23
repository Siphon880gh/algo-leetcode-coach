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
            'message' => "Read the problem statement above.\nBuild what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sorted first half, then mirror it', 'next' => 's2'],
                ['label' => 'Sort the whole string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. babab → aabbb, which is not a palindrome.\nStep back to when you sorted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letter with an odd count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it out', 'next' => 'wrong_b'],
                ['label' => 'Put one copy in the middle', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → abba instead of abbba.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → z, abbba, acddca.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
