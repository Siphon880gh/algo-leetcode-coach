## Each attack contributes until the next one

The poison from attack `i` lasts `duration` seconds, but it is cut short if attack `i + 1` comes sooner. So attack `i` adds `min(duration, timeSeries[i + 1] − timeSeries[i])`, and the last attack adds a full `duration`. Sum it in one pass.

This is merging intervals `[t, t + duration)` that arrive sorted, without building them. Merge Intervals (56) builds the merged list for unsorted input.

Do not add `duration` for every attack — overlaps double count. Do not use `duration − 1` — the interval is inclusive of both ends, so it is `duration` seconds long. The total can reach 1e4 × 1e7 = 1e11, so use 64 bits in languages with 32-bit ints (LeetCode's tests fit in 32 bits, but be safe).

Time: O(n)  
Space: O(1)

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
