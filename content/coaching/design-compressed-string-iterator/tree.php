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
            'message' => "Problem: StringIterator(\"L1e2t1C1o1d1e1\"): each letter is followed by how many times it repeats (the count can have several digits). next() returns the next letter, or a single space when none is left; hasNext() says whether any letters remain. (Restated from memory; limits and examples may differ slightly.)\nExpand the string in the constructor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: parse it into (letter, count) runs', 'next' => 's2'],
                ['label' => 'Yes: build the full uncompressed string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counts can be up to 10⁹, so the expanded string may not fit in memory.\nStep back to when you expanded it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you read a count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Read one digit after the letter', 'next' => 'wrong_b'],
                ['label' => 'Read every digit after the letter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a12 means twelve a's, not one a followed by garbage.\nStep back to when you read one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "next() is called with nothing left. What does it return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A single space \' \'', 'next' => 'success'],
                ['label' => 'An empty string', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The contract asks for a space when the iterator is exhausted.\nStep back to when you returned an empty string.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Parsed runs, a pointer plus a remaining count, and a space at the end: O(1) amortized per call.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
