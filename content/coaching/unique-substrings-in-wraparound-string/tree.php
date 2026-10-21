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
                ['label' => 'Describe each valid substring by its last letter and its length', 'next' => 's2'],
                ['label' => 'Put every valid substring in a set and return its size', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. There are up to n² / 2 = 5e9 substrings. Storing them in a set is far too slow and too big.\nStep back to when you collected every substring.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walk s with k = current valid run length: k += 1 if s[i] is s[i − 1] + 1 (z → a wraps), else k = 1.\nWhat do you store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'answer += k at each index', 'next' => 'wrong_b'],
                ['label' => 'best[s[i]] = max(best[s[i]], k)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Adding k each step counts the same substring every time it appears. \"aa\" would give 2 instead of 1.\nStep back to when you added k every step.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "If the longest valid run ending at c has length L, all L shorter ones ending at c also exist and are distinct. Sum best over 26 letters. O(n) time, O(1) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Max run per ending letter, wrap z → a, sum the 26 maxima', 'next' => 'success'],
                ['label' => 'Treat z → a as a break in the run', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without the wrap, \"za\" is not seen as consecutive, and \"zab\" gives 4 instead of 6.\nStep back to when you dropped the z → a wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Longest valid run ending at each letter, summed over 26 letters. \"zab\" → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
