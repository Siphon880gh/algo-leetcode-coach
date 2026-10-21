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
            'message' => "Problem: AutocompleteSystem(sentences, times); input(c) receives one character at a time. For a letter or space, return the top 3 past sentences that start with what has been typed so far, by count descending and then ASCII. \"#\" ends the sentence: record it (count + 1), reset, and return []. (Restated from memory; limits and examples may differ slightly.)\nWalk the trie from the root on every character?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep the node of the current prefix and step one child down', 'next' => 's2'],
                ['label' => 'Yes: walk the whole prefix again', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That repeats O(prefix length) work per keystroke; the pointer only needs one step.\nStep back to when you restarted from the root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you rank the matching sentences?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count only', 'next' => 'wrong_b'],
                ['label' => 'Count descending, then ASCII ascending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties are broken by ASCII order, so \"i love leetcode\" comes before \"ironman\".\nStep back to when you ignored ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The input is '#'. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1 to the typed sentence (inserting it if new), reset the prefix, return []', 'next' => 'success'],
                ['label' => 'Return the top 3 for the full sentence', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. # ends the input; it returns an empty list and records the sentence.\nStep back to when you returned suggestions.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A trie with counts, a moving prefix node, and (−count, sentence) ranking: fast per keystroke.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
