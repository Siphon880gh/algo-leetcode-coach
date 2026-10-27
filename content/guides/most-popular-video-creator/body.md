## Two maps

1. For each video `(c, id, v)`: `total[c] += v`; replace `best[c]` if `v` is larger, or equal with a smaller `id`.
2. `m = max(total)`.
3. Return `[c, best[c].id]` for every `c` with `total[c] = m`.

Examples → [[alice, one], [bob, two]], [[alice, b]].

A creator with all videos at 0 views still has a best video, so compare with ≥ the first time or seed it with the first video. Totals reach 10^5 · 10^5 = 10^10, so use 64-bit.

Time: O(n · L)  
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
