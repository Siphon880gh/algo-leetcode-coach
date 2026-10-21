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
                ['label' => 'Count each character exactly as it appears', 'next' => 's2'],
                ['label' => 'Lowercase s first so A and a share a count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Case matters: A and a are different characters. Lowercasing changes the answer.\nStep back to when you normalized the case.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Counts for \"cccaaa\": c → 3, a → 3.\nHow do you build the output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the characters of s with key = count of that character', 'next' => 'wrong_b'],
                ['label' => 'Sort the distinct characters by count and write each one count times', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sorting characters one by one by their count can interleave ties, giving \"cacaca\", which is invalid.\nStep back to when you sorted individual characters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "At most 62 distinct characters, so sorting them is constant work: O(n) time overall. Bucket by count is the no-sort version. Top K Frequent Elements (347) returns values, not a string.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count, group by count descending, write each group whole. Not 347', 'next' => 'success'],
                ['label' => 'Sort counts ascending', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The order is by count, most frequent first. Ascending puts the rarest first.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count, sort distinct characters by count descending, write each one count times. \"tree\" → \"eert\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
