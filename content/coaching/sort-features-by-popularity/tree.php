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
            'message' => "Problem: Given a list of feature words and a list of user responses (space-separated words), a feature's popularity is the number of responses that mention it, counted at most once per response. Return the features sorted by popularity, most popular first, keeping the original order on ties. For instance, features [cooler, lock, touch] with responses [\"i like cooler cooler\", \"lock touch cool\", \"locker like touch\"] → [touch, cooler, lock]. (Restated from memory; limits and examples may differ slightly.)\nRepeated word in one response?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts once (use a set)', 'next' => 's2'],
                ['label' => 'Counts each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Popularity counts responses, not mentions.\nStep back to when you counted each mention.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Matching rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Substring search', 'next' => 'wrong_b'],
                ['label' => 'Whole words after splitting', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A longer word containing the feature is not a mention.\nStep back to when you searched substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Tie order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Original feature order', 'next' => 'success'],
                ['label' => 'Alphabetical', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties keep the input order.\nStep back to when you sorted alphabetically.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(words + f log f). Constructed check → [touch, cooler, lock].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
