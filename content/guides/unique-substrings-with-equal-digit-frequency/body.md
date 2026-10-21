Given a string s of digits, return the number of distinct substrings in which every digit that appears occurs the same number of times. The string is short enough for quadratic work. For instance, "1212" → 5 ("1", "2", "12", "21", "1212"); "111" → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Balanced test in O(1) per extension

1. For each `i`: reset counts, `mx = 0`, `kinds = 0`.
2. For `j = i …`: add `s[j]`, update `kinds` and `mx`; if `kinds · mx = j − i + 1`, add `s[i … j]` (or its hash) to a set.
3. Return the set size.

Constructed checks (verified by brute force): "1212" → 5, "111" → 3, "12321" → 9.

The test works because every count is at most `mx`, so the total equals `kinds · mx` only when all counts equal `mx`. Storing hashes instead of strings keeps memory at O(n²) integers.

Time: O(n²) with hashing  
Space: O(n²)

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
