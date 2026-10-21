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
                ['label' => 'Sort both; match the least greedy child with the smallest cookie that fits', 'next' => 's2'],
                ['label' => 'Give the biggest cookies to children in input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Giving the biggest cookie to the least greedy child wastes it. g = [1,3], s = [1,3]: handing 3 to child 1 leaves 1 for child 3, so only one is fed.\nStep back to when you used the biggest cookies first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pointers i (child) and j (cookie), both sorted ascending.\nIf s[j] < g[i], what moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i: skip this child', 'next' => 'wrong_b'],
                ['label' => 'Only j: that cookie cannot feed anyone left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A cookie too small for the least greedy child is too small for every child left. Skipping the child instead loses a child you could still feed.\nStep back to when you skipped the child.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "If s[j] >= g[i], feed child i and move both. Answer is i at the end. O(n log n + m log m). Candy (135) is a different greedy.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort, smallest fitting cookie, skip small cookies. Not 135', 'next' => 'success'],
                ['label' => 'Combine two small cookies for one greedy child', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each child gets at most one cookie. Combining cookies breaks the rule.\nStep back to when you combined cookies.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort both, feed the least greedy child with the smallest cookie that fits. g = [1,2,3], s = [1,1] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
