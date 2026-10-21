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
                ['label' => 'Split into two halves: pairs from arrays 1 and 2, pairs from arrays 3 and 4', 'next' => 's2'],
                ['label' => 'Four nested loops over every tuple', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 200^4 is 1.6e9 combinations, too slow.\nStep back to when you used four loops.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Map from a + b to how many (i, j) pairs give it.\nWhy a count and not a set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A set is enough; duplicates do not matter', 'next' => 'wrong_b'],
                ['label' => 'Different index pairs with the same sum each make separate tuples', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Tuples are counted by index. Two different (i, j) pairs with the same sum are two different tuples.\nStep back to when you stored only presence.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For each c + d, add count[−(c + d)]. O(n²) time and space. 4Sum (18) wants unique value quadruplets from one array, so it sorts and uses two pointers.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pair-sum counts, then look up the negation. Not 18', 'next' => 'success'],
                ['label' => 'Sort all four arrays and run two pointers', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two pointers on sorted arrays finds unique value sets, not counts of index tuples across four arrays.\nStep back to when you sorted and used two pointers.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count pair sums from the first two arrays, look up negated pair sums from the last two. Example → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
