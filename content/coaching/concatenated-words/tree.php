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
                ['label' => 'For each word, ask whether it can be split into dictionary words (Word Break)', 'next' => 's2'],
                ['label' => 'Try all pairs and triples of words and see which concatenations exist', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Trying all pairs and triples of words explodes and misses longer chains like rat + cat + dog + cat.\nStep back to when you combined words.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Running Word Break with the full list, every word splits into just itself.\nHow do you stop that?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove the word from the set, check, put it back', 'next' => 'wrong_b'],
                ['label' => 'Sort by length; check each word against the words added so far, then add it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Removing only the word itself still leaves longer words, which can never be pieces, so the check wastes time. Sorting by length handles both issues.\nStep back to when you removed only the word itself.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Every piece is strictly shorter, so a successful split uses at least two pieces. Word Break DP: ok[0] = true; ok[i] if some ok[j] and w[j..i − 1] in the set. A trie speeds up the inner loop.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort by length, Word Break against shorter words, skip empty. Not 139 alone', 'next' => 'success'],
                ['label' => 'Keep the empty string in the dictionary', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The empty string splits into anything with zero-length pieces and breaks the DP.\nStep back to when you kept the empty word.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort by length, Word Break each word against the shorter ones, then add it. Example → 3 words.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
