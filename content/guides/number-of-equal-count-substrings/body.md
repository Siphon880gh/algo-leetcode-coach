Given a string s of lowercase letters and an integer count, a substring is an equal count substring if every distinct letter in it appears exactly count times. Return the number of equal count substrings. For instance, "aaabcbbcc" with count 3 → 3, "abcd" with count 2 → 0, and "a" with count 5 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Length is forced

1. For `u = 1 … 26` with `L = u · count ≤ n`: slide a window of length `L`, maintaining letter counts.
2. A window is valid when it has exactly `u` distinct letters and all of them occur `count` times (track how many letters sit at exactly `count`).
3. Sum the valid windows.

Constructed checks (verified against every substring on random strings): the three cases above → 3, 0, 0.

Fixing the number of distinct letters fixes the length, so 26 fixed-size windows cover every candidate.

Time: O(26 · n)  
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
