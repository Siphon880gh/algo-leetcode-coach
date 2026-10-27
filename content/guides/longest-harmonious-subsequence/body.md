## Pairs of adjacent values

A subsequence does not have to be contiguous, so only the counts matter. Its max and min differ by exactly 1, so it uses exactly two values, `x` and `x + 1`, and it might as well take every copy of both.

1. `cnt` = a count of each value.
2. For each `x` in `cnt` with `x + 1` in `cnt`: `ans = max(ans, cnt[x] + cnt[x + 1])`.

Return `ans`, which is 0 when no adjacent pair exists. Sorting and then sliding over the sorted values also works, in O(n log n).

Do not count a single value on its own; max − min must be exactly 1, not 0. Do not look for contiguous windows in the original order; it is a subsequence.

Time: O(n)  
Space: O(n)

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
