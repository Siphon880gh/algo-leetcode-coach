You are given a string of even length n. A string is an anti-palindrome when s[i] ≠ s[n − 1 − i] for every i. Rearrange s into the lexicographically smallest anti-palindrome, or return the not-found value the statement gives. Limits are in the official statement. For instance, abca → aabc, and cccd has no anti-palindrome. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sorted plus a repair

1. Sort s. c = s[n/2 − 1]; i = first index ≥ n/2 with s[i] ≠ c.
2. For j = n/2, n/2 + 1, … while s[j] = s[n − 1 − j]: if i = n, return not found; swap s[i], s[j]; i += 1.
3. Return s.

Constructed checks (run in code): abca → aabc; abba → aabb; cccd → not found; abbbcc → abbccb; 1,500 random strings match trying every permutation.

Sorting alone is not enough: abbbcc sorted puts b opposite b.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
