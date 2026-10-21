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
                ['label' => 'side = total / 4; backtrack each stick into one of 4 sides', 'next' => 's2'],
                ['label' => 'Fill one side at a time with whatever sticks fit first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy filling can lock a stick into the wrong side. [3,3,3,3,2,2,2,2] with side 5 needs 3 + 2 on every side; filling a side with 2 + 2 first breaks it.\nStep back to when you filled sides greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Before searching, what quick checks apply?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None; the search will find out', 'next' => 'wrong_b'],
                ['label' => 'total % 4 == 0 and the longest stick ≤ side', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A stick longer than side can never fit, and a total not divisible by 4 has no square. Skipping these wastes the whole search.\nStep back to when you skipped the checks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort descending so long sticks fail fast. If two sides have the same current length, trying the second repeats the search, so skip it. Bitmask DP over used sticks is the alternative. 698 is the general k version.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Checks, descending order, skip equal sides. 698 generalizes', 'next' => 'success'],
                ['label' => 'Sort ascending', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ascending order puts short sticks first, and the search explores many fillings before a long stick fails.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Divisibility and longest-stick checks, then backtrack longest first with equal-side pruning. [1,1,2,2,2] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
