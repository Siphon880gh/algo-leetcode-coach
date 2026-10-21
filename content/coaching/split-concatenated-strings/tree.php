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
            'message' => "Problem: strs has up to 1000 strings, total length up to 1000. Join them in order into a loop, reversing any of them, then cut the loop at one point to get a single string. Return the lexicographically largest result. [\"abc\",\"xyz\"] → \"zyxcba\". (Restated from memory; limits and examples may differ slightly.)\nThe strings you do not cut: which way round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The larger of s and its reverse', 'next' => 's2'],
                ['label' => 'Keep them as given', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An uncut string appears whole in the result, so its larger orientation is always at least as good.\nStep back to when you kept the input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where can the cut go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only between two strings', 'next' => 'wrong_b'],
                ['label' => 'Inside any string i, in either orientation, at any position j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In [\"lc\",\"evol\",\"cdy\"] the answer ylclovecd starts in the middle of cdy.\nStep back to when you cut only between strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "String i, orientation t, cut j: what is the candidate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't[j:] + the other strings (after i, then before i, each oriented best) + t[:j]', 'next' => 'success'],
                ['label' => 'Only cut at the largest letter of t', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Several positions can hold the largest letter, and ties are broken by what follows. With total length 1000, try every j.\nStep back to when you picked one cut.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Best orientation for uncut strings, then every string, both orientations, and every cut: O(L²) time for total length L.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
