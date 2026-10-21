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
            'message' => "Problem: up to 400 distinct words (2 to 400 letters). Start each abbreviation as first + middle count + last; grow clashing prefixes until unique; keep the word if not shorter. \"internet\" → \"i6t\", \"intension\" → \"inte4n\". (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Find which words can ever clash, and how long each prefix must be', 'next' => 's2'],
                ['label' => 'Simulate rounds: grow all clashing prefixes and recompare everything', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rounds of growing prefixes and rechecking every pair can take O(L) rounds over O(n²) pairs.\nStep back to when you simulated rounds globally.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which words can share an abbreviation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any words with the same first letter', 'next' => 'wrong_b'],
                ['label' => 'Same length, same first letter, same last letter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Same first letter is not enough; the count and last letter must match too.\nStep back to when you grouped by first letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In a group, p = 1 + max LCP with any other word (trie counts, or sorted neighbors). abbr = word[:p] + str(len − p − 1) + word[−1].\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Group, p = 1 + max LCP, keep the word if not shorter', 'next' => 'success'],
                ['label' => 'Always use the abbreviation', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"internal\" vs \"interval\": p = 6 gives \"intern1l\", 8 letters, no shorter. Keep the word.\nStep back to when you always abbreviated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Group by (len, first, last), prefix past the longest shared prefix. \"internet\" → \"i6t\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
