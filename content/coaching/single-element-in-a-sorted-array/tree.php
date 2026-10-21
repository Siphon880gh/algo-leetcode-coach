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
                ['label' => 'Binary search on where the pairing shifts', 'next' => 's2'],
                ['label' => 'XOR all values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. XOR of everything is O(n); the problem asks for O(log n).\nStep back to when you XORed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "mid is even.\nnums[mid] == nums[mid + 1] means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The single is to the left: hi = mid − 1', 'next' => 'wrong_b'],
                ['label' => 'The single is to the right: lo = mid + 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matching at an even start means pairs are still aligned through mid + 1; the single is further right.\nStep back to when you went left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Otherwise hi = mid (mid may be the answer). Stop when lo == hi. Shortcut: compare with nums[mid ^ 1].\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Even mid, compare mid + 1, lo = mid + 2 or hi = mid', 'next' => 'success'],
                ['label' => 'Use any mid and compare nums[mid + 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. For odd mid, the partner is mid − 1. Testing mid + 1 reads the wrong pair.\nStep back to when you allowed odd mid.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Pair alignment binary search. → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
