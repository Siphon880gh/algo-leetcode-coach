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
            'message' => "Read the problem statement above.\nFirst word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All lowercase', 'next' => 's2'],
                ['label' => 'Capitalized like the rest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → #LeetcodeDailyStreakAchieved instead of #leetcodeDailyStreakAchieved.\nStep back to when you capitalized it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Truncate what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The letters to 100, then add #', 'next' => 'wrong_b'],
                ['label' => 'The whole tag, # included, to 100', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 101 characters instead of 100.\nStep back to when you cut before the #.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → #leetcodeDailyStreakAchieved, #canIGoThere, # plus 99 h.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
