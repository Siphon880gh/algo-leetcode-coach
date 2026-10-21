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
            'message' => "Read the problem statement above.\nHow do you match words to roots?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Put the roots in a trie and walk each word once', 'next' => 's2'],
                ['label' => 'Test every root against every word with startswith', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(words · roots · length); a trie walks each word letter by letter once.\nStep back to when you tested every root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walking a word, you reach a node that ends a root. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep going to find the longest root', 'next' => 'wrong_b'],
                ['label' => 'Stop and replace the word with this shortest root', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The problem asks for the shortest root.\nStep back to when you kept walking.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The trie has no child for the next letter. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the word unchanged', 'next' => 'success'],
                ['label' => 'Replace it with the prefix you reached', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That prefix is not a root, so the word stays as it is.\nStep back to when you used the partial prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Trie of roots, first root on the path wins: O(total length). [\"cat\",\"bat\",\"rat\"], \"the cattle was rattled by the battery\" → \"the cat was rat by the bat\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
