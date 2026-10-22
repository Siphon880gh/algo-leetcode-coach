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
            'message' => "Read the problem statement above.\nCount which ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every end with all vowels and k consonants', 'next' => 's2'],
                ['label' => 'Only the first such end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. aeiouu, k = 0 → 1 instead of 2.\nStep back to when you stopped at the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop extending when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any consonant appears', 'next' => 'wrong_b'],
                ['label' => 'Consonants exceed k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 0 instead of 3.\nStep back to when you stopped at a consonant.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 0, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
