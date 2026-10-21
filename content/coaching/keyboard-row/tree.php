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
                ['label' => 'Build a map letter → row once', 'next' => 's2'],
                ['label' => 'For each letter, search each row string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Checking all three row strings for every letter works but repeats searches.\nStep back to when you searched the row strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"Alaska\".\nHow do you look letters up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the letter as it is', 'next' => 'wrong_b'],
                ['label' => 'Lowercase each letter first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 'A' is not in \"asdfghjkl\". Uppercase letters would fail.\nStep back to when you used the raw case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Keep the word if every row[c] equals row[word[0]]. O(total letters).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letter → row map, lowercase lookups, return the originals', 'next' => 'success'],
                ['label' => 'Return the lowercased words', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Returning lowercased words changes the output; the answer keeps the original spelling.\nStep back to when you returned lowercase words.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One map, case-insensitive check, original words. → [\"Alaska\",\"Dad\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
