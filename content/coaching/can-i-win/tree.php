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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search the game: a position wins if some move wins at once or leaves the opponent losing', 'next' => 's2'],
                ['label' => 'Always take the largest number left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Taking the biggest number is not always best. 10, 11 → false shows every first move loses, and greedy cannot see that.\nStep back to when you played greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The state needs the used numbers and the total.\nWhat do you memoize on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The running total only', 'next' => 'wrong_b'],
                ['label' => 'The bitmask of used numbers (the total follows from it)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Different used sets can share a total but leave different numbers to play. Memoizing on the total mixes them up.\nStep back to when you keyed on the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Up to 2^20 masks, 20 moves each. Exits first: desiredTotal <= 0 → true. Sum of 1..max < desiredTotal → false, since nobody can reach it.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mask memo, desiredTotal <= 0 → true, sum too small → false', 'next' => 'success'],
                ['label' => 'Skip the sum check; the search handles it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If all numbers together cannot reach the target, no one wins. Without this check, running out of numbers counts as a loss for the player to move, so whoever picked last looks like a winner.\nStep back to when you skipped the sum check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Memo on the used mask, win if any move wins now or leaves the opponent losing, with the two quick exits. 10, 11 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
