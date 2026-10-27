## Brute force by length

1. For each i and L = 1 … |arr[i]|: candidates = sorted distinct substrings of length L.
2. Return the first candidate that is not a substring of any arr[j], j ≠ i; if none at any length, “”.

Examples → [ab, “”, ba, “”], [“”, “”, abcd].

Exclude the string itself from the check: including it makes every answer empty. Each string has at most 210 substrings, each checked against 99 others.

Time: O(n² · L³)  
Space: O(L²)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
