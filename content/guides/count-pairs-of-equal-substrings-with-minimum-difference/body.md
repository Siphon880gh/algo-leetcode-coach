Given two strings, count the index quadruples (i, j, a, b) where the first string's substring i … j equals the second string's substring a … b and j − a is as small as possible among all such equal-substring quadruples. For instance, "abcd" and "bccda" → 1, "ab" and "ab" → 2, and "ab" and "cd" → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Reduce to letters

1. `first[c]` = first index of `c` in the first string; `last[c]` = last index in the second.
2. For letters in both: `d = first[c] − last[c]`.
3. Return how many letters reach the minimum `d` (0 if none are shared).

Constructed checks (verified by brute force over all substring pairs): `"abcd", "bccda"` → 1, `"ab", "ab"` → 2, `"aab", "baa"` → 1, `"ab", "cd"` → 0.

Any longer equal pair starts with an equal letter pair whose `i − a` is smaller than its `j − a`. Each letter contributes at most one quadruple: its first and last positions are unique.

Time: O(m + n)  
Space: O(26)

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
